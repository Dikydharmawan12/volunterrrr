#!/bin/bash

echo "=== Laravel Application Debug Script ==="
echo ""

# Check if we're in a Docker container
if [ -f /.dockerenv ]; then
    echo "Running inside Docker container"
    echo ""
    
    # Check PHP-FPM status
    echo "=== PHP-FPM Status ==="
    ps aux | grep php-fpm
    echo ""
    
    # Check Nginx status
    echo "=== Nginx Status ==="
    ps aux | grep nginx
    echo ""
    
    # Check Laravel logs
    echo "=== Laravel Logs ==="
    if [ -f /var/www/html/storage/logs/laravel.log ]; then
        tail -50 /var/www/html/storage/logs/laravel.log
    else
        echo "Laravel log file not found"
    fi
    echo ""
    
    # Check Nginx error logs
    echo "=== Nginx Error Logs ==="
    if [ -f /var/log/nginx/error.log ]; then
        tail -20 /var/log/nginx/error.log
    else
        echo "Nginx error log not found"
    fi
    echo ""
    
    # Check file permissions
    echo "=== File Permissions ==="
    ls -la /var/www/html/storage/
    ls -la /var/www/html/bootstrap/cache/
    echo ""
    
    # Check database
    echo "=== Database Status ==="
    if [ -f /var/www/html/database/database.sqlite ]; then
        echo "Database file exists"
        ls -la /var/www/html/database/database.sqlite
    else
        echo "Database file not found"
    fi
    echo ""
    
    # Check environment
    echo "=== Environment Variables ==="
    echo "APP_ENV: $APP_ENV"
    echo "APP_DEBUG: $APP_DEBUG"
    echo "DB_CONNECTION: $DB_CONNECTION"
    echo "DB_DATABASE: $DB_DATABASE"
    echo ""
    
    # Test Laravel artisan
    echo "=== Laravel Artisan Test ==="
    cd /var/www/html
    php artisan --version
    echo ""
    
    # Check routes
    echo "=== Route List ==="
    php artisan route:list --compact
    echo ""
    
else
    echo "Not running in Docker container"
    echo "To debug inside container, run: docker exec -it <container_name> bash"
    echo "Then run: ./debug.sh"
fi

echo "=== Debug Complete ===" 