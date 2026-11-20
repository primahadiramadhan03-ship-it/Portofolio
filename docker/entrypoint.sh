#!/bin/bash
set -e

echo "Starting deployment entrypoint..."

# Create storage symlink
php artisan storage:link || true

# Run migrations and seeders
if [ -n "$DB_HOST" ] || [ -n "$DATABASE_URL" ]; then
    echo "Running database migrations..."
    php artisan migrate --force || true
    echo "Running database seeders..."
    php artisan db:seed --force || true
fi

# Cache configurations for production performance
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Starting services via Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
