#!/bin/bash

echo "=== Laravel Application Startup Script ==="
echo ""

# Wait for services to be ready
echo "Waiting for services to be ready..."
sleep 5

# Run debug script
echo "Running debug script..."
./debug.sh

echo ""
echo "=== Starting Laravel Services ==="

# Set proper permissions
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

# Clear any cached configs
php artisan config:clear || echo "Config clear failed"
php artisan route:clear || echo "Route clear failed"
php artisan view:clear || echo "View clear failed"

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="echo 'Database connected: ' . (DB::connection()->getPdo() ? 'YES' : 'NO');" 2>/dev/null || echo "Database connection failed"

# Run migrations if needed
echo "Running migrations..."
php artisan migrate --force || echo "Migration failed"

# Cache configs for production
echo "Caching configurations..."
php artisan config:cache || echo "Config cache failed"
php artisan route:cache || echo "Route cache failed"
php artisan view:cache || echo "View cache failed"

echo ""
echo "=== Laravel Ready ==="
echo "Starting supervisor..."

# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf 