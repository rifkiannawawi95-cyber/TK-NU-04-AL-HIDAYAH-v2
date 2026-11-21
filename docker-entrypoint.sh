#!/bin/sh

# Buat symbolic link storage jika belum ada
php artisan storage:link --no-interaction 2>/dev/null || true

# Optimasi caching Laravel di production jika APP_KEY terpasang
if [ -n "$APP_KEY" ]; then
    echo "Caching Laravel configuration and routes for production..."
    php artisan package:discover --ansi 2>/dev/null || true
    php artisan config:cache 2>/dev/null || true
    php artisan route:cache 2>/dev/null || true
    php artisan view:cache 2>/dev/null || true
fi

exec "$@"
