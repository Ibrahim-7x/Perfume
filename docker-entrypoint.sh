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
# Set safe defaults for drivers that don't require a DB
# connection at boot. These can be overridden by setting
# the env vars in the Render dashboard.
# -------------------------------------------------------
export SESSION_DRIVER="${SESSION_DRIVER:-file}"
export CACHE_STORE="${CACHE_STORE:-file}"
export QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"
export SESSION_ENCRYPT="${SESSION_ENCRYPT:-false}"

# -------------------------------------------------------
# Build .env from environment variables so Laravel can
# read them through both env() and config caching.
# -------------------------------------------------------
cat > .env <<EOF
APP_NAME="${APP_NAME:-Laravel}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost}"

LOG_CHANNEL="${LOG_CHANNEL:-stderr}"
LOG_LEVEL="${LOG_LEVEL:-error}"

DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-troy_perfumes}"
DB_USERNAME="${DB_USERNAME:-root}"
DB_PASSWORD="${DB_PASSWORD:-}"

SESSION_DRIVER="${SESSION_DRIVER}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"
SESSION_ENCRYPT=${SESSION_ENCRYPT}

CACHE_STORE="${CACHE_STORE}"
QUEUE_CONNECTION="${QUEUE_CONNECTION}"

FILESYSTEM_DISK="${FILESYSTEM_DISK:-local}"

MAIL_MAILER="${MAIL_MAILER:-log}"
MAIL_HOST="${MAIL_HOST:-}"
MAIL_PORT="${MAIL_PORT:-587}"
MAIL_USERNAME="${MAIL_USERNAME:-}"
MAIL_PASSWORD="${MAIL_PASSWORD:-}"
MAIL_FROM_ADDRESS="${MAIL_FROM_ADDRESS:-hello@example.com}"
MAIL_FROM_NAME="${MAIL_FROM_NAME:-\${APP_NAME}}"

VITE_APP_NAME="\${APP_NAME}"
EOF

echo "✓ .env generated from environment variables"

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
    echo "✓ Application key generated"
    echo "⚠  IMPORTANT: Copy the APP_KEY from above and set it in Render's Environment Variables"
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
