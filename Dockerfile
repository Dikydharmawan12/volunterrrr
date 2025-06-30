# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Copy health check file
COPY health-check.php /var/www/html/health-check.php

# Copy startup script
COPY start.sh /var/www/html/start.sh

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install npm dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/public \
    && chmod +x /var/www/html/start.sh

# Copy nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Copy supervisor configuration
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create proper .env file for production
RUN echo 'APP_NAME="Pendaftaran Divisi"' > .env && \
    echo 'APP_ENV=production' >> .env && \
    echo 'APP_DEBUG=false' >> .env && \
    echo 'APP_URL=https://volunterrr-production.up.railway.app' >> .env && \
    echo 'LOG_CHANNEL=stack' >> .env && \
    echo 'LOG_DEPRECATIONS_CHANNEL=null' >> .env && \
    echo 'LOG_LEVEL=debug' >> .env && \
    echo 'DB_CONNECTION=mysql' >> .env && \
    echo 'DB_HOST=127.0.0.1' >> .env && \
    echo 'DB_PORT=3306' >> .env && \
    echo 'DB_DATABASE=volunter' >> .env && \
    echo 'DB_USERNAME=root' >> .env && \
    echo 'DB_PASSWORD=' >> .env && \
    echo 'BROADCAST_DRIVER=log' >> .env && \
    echo 'CACHE_DRIVER=file' >> .env && \
    echo 'FILESYSTEM_DISK=local' >> .env && \
    echo 'QUEUE_CONNECTION=sync' >> .env && \
    echo 'SESSION_DRIVER=file' >> .env && \
    echo 'SESSION_LIFETIME=120' >> .env

# Generate application key
RUN php artisan key:generate --force

# Create debug script
RUN echo '#!/bin/bash' > /var/www/html/debug.sh && \
    echo 'echo "=== Laravel Application Debug Script ==="' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== Environment Variables ==="' >> /var/www/html/debug.sh && \
    echo 'echo "APP_ENV: $APP_ENV"' >> /var/www/html/debug.sh && \
    echo 'echo "APP_DEBUG: $APP_DEBUG"' >> /var/www/html/debug.sh && \
    echo 'echo "DB_CONNECTION: $DB_CONNECTION"' >> /var/www/html/debug.sh && \
    echo 'echo "DB_HOST: $DB_HOST"' >> /var/www/html/debug.sh && \
    echo 'echo "DB_DATABASE: $DB_DATABASE"' >> /var/www/html/debug.sh && \
    echo 'echo "APP_KEY: $APP_KEY"' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== Laravel Logs ==="' >> /var/www/html/debug.sh && \
    echo 'if [ -f /var/www/html/storage/logs/laravel.log ]; then' >> /var/www/html/debug.sh && \
    echo '    tail -20 /var/www/html/storage/logs/laravel.log' >> /var/www/html/debug.sh && \
    echo 'else' >> /var/www/html/debug.sh && \
    echo '    echo "Laravel log file not found"' >> /var/www/html/debug.sh && \
    echo 'fi' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== File Permissions ==="' >> /var/www/html/debug.sh && \
    echo 'ls -la /var/www/html/storage/' >> /var/www/html/debug.sh && \
    echo 'ls -la /var/www/html/bootstrap/cache/' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== Laravel Artisan Test ==="' >> /var/www/html/debug.sh && \
    echo 'cd /var/www/html' >> /var/www/html/debug.sh && \
    echo 'php artisan --version' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== Database Connection Test ==="' >> /var/www/html/debug.sh && \
    echo 'php artisan tinker --execute="echo \"Database connected: \" . (DB::connection()->getPdo() ? \"YES\" : \"NO\");" 2>/dev/null || echo "Database connection failed"' >> /var/www/html/debug.sh && \
    echo 'echo ""' >> /var/www/html/debug.sh && \
    echo 'echo "=== Debug Complete ==="' >> /var/www/html/debug.sh && \
    chmod +x /var/www/html/debug.sh

# Run migrations with error handling
RUN php artisan migrate --force || echo "Migration failed, continuing..."

# Clear and cache config with error handling
RUN php artisan config:clear || echo "Config clear failed" && \
    php artisan config:cache || echo "Config cache failed" && \
    php artisan route:clear || echo "Route clear failed" && \
    php artisan route:cache || echo "Route cache failed" && \
    php artisan view:clear || echo "View clear failed" && \
    php artisan view:cache || echo "View cache failed"

# Create health check file
COPY health-check.php /var/www/html/health-check.php

# Expose port 8080
EXPOSE 8080

# Start with debug script
CMD ["/var/www/html/start.sh"] 