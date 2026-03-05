#!/bin/bash
set -e

# -------------------------------------------------------
# Render provides the PORT env var (default 10000).
# Configure Apache to listen on that port at runtime.
# -------------------------------------------------------
PORT="${PORT:-10000}"

# Update Apache listen port
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/*.conf

echo "✓ Apache will listen on port ${PORT}"

# -------------------------------------------------------
# Generate .env if it doesn't exist (Render passes env
# vars through its dashboard — they're already in $_ENV)
# -------------------------------------------------------
if [ ! -f .env ]; then
    echo "APP_KEY=" > .env
fi

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
    echo "✓ Application key generated"
fi

# -------------------------------------------------------
# Cache configuration, routes & views for performance
# -------------------------------------------------------
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✓ Caches warmed"

# -------------------------------------------------------
# Run database migrations (safe for production with --force)
# -------------------------------------------------------
php artisan migrate --force 2>/dev/null && echo "✓ Migrations complete" || echo "⚠ Migrations skipped (database may not be ready)"

# -------------------------------------------------------
# Ensure correct ownership after any cache writes
# -------------------------------------------------------
chown -R www-data:www-data storage bootstrap/cache

echo "✓ Starting Apache on port ${PORT}…"
exec apache2-foreground
