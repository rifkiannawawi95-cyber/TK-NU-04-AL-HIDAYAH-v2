#!/bin/sh

# Buat symbolic link storage jika belum ada
[ ! -L public/storage ] && php artisan storage:link --no-interaction 2>/dev/null || true

# Optimasi caching config dan route untuk booting instan
if [ -n "$APP_KEY" ]; then
    php artisan config:cache 2>/dev/null || true
    php artisan route:cache 2>/dev/null || true
fi

exec "$@"
