#!/bin/sh
set -e

# Buat symbolic link storage jika belum ada
php artisan storage:link --no-interaction || true

# Optimasi caching Laravel di production jika APP_KEY terpasang
if [ -n "$APP_KEY" ]; then
    echo "Caching Laravel configuration and routes for production..."
    php artisan package:discover --ansi || true
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

exec "$@"
