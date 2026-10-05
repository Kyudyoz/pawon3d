#!/bin/sh
set -e

# Fallback PORT if Render doesn't pass one
PORT=${PORT:-8080}
sed -i "s/PORT_PLACEHOLDER/$PORT/g" /etc/nginx/http.d/default.conf

# Ensure storage directories exist
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
touch /var/www/html/storage/logs/laravel.log

# Create storage symlink
php artisan storage:link || true

# Clear any stale build cache
php artisan config:clear || true

# Package discovery (runs now with runtime environment loaded)
php artisan package:discover --ansi || true

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force || true

# Optimize cache
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Ensure permissions AFTER all artisan commands run
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Starting PHP-FPM..."
php-fpm -D

echo "Starting Nginx on port $PORT..."
exec nginx -g "daemon off;"
