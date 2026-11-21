# Multi-stage Dockerfile: Laravel 13 + FrankenPHP on Vercel Container Runtime

# Stage 1: Build Frontend Assets (Vite & Tailwind)
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package.json vite.config.js ./
RUN npm install
COPY resources/ ./resources/
COPY public/ ./public/
RUN npm run build

# Stage 2: Install Composer Production Dependencies
FROM composer:2 AS vendor-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --optimize-autoloader

# Stage 3: Production FrankenPHP Runner
FROM dunglas/frankenphp:1-php8.4

# Install required PHP extensions for Laravel & MySQL
RUN install-php-extensions \
    pdo_mysql \
    gd \
    zip \
    opcache \
    bcmath \
    intl \
    exif \
    pcntl

WORKDIR /app

# Copy application code
COPY . /app

# Copy built vendor and assets from previous stages
COPY --from=frontend-builder /app/public/build /app/public/build
COPY --from=vendor-builder /app/vendor /app/vendor

# Copy Caddyfile configuration
COPY Caddyfile /etc/caddy/Caddyfile

# Production PHP settings
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 20M/g' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/post_max_size = 8M/post_max_size = 25M/g' "$PHP_INI_DIR/php.ini"

# Prepare storage directories and writable permissions
RUN mkdir -p /app/storage/framework/cache/data \
             /app/storage/framework/sessions \
             /app/storage/framework/views \
             /app/storage/logs \
             /app/bootstrap/cache \
             /app/certs && \
    chmod -R 777 /app/storage /app/bootstrap/cache

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Vercel container port
EXPOSE 80 443 3000

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
