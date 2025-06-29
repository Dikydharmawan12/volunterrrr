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
    sqlite3 \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Copy health check file
COPY health-check.php /var/www/html/health-check.php

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
    && chmod -R 755 /var/www/html/public

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
    echo 'DB_CONNECTION=sqlite' >> .env && \
    echo 'DB_DATABASE=/var/www/html/database/database.sqlite' >> .env && \
    echo 'BROADCAST_DRIVER=log' >> .env && \
    echo 'CACHE_DRIVER=file' >> .env && \
    echo 'FILESYSTEM_DISK=local' >> .env && \
    echo 'QUEUE_CONNECTION=sync' >> .env && \
    echo 'SESSION_DRIVER=file' >> .env && \
    echo 'SESSION_LIFETIME=120' >> .env

# Generate application key
RUN php artisan key:generate --force

# Create database directory and file
RUN mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/database \
    && chmod 664 /var/www/html/database/database.sqlite

# Set environment variable untuk path database
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_URL=https://volunterrr-production.up.railway.app

# Run migrations
RUN php artisan migrate --force

# Clear and cache config
RUN php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:clear \
    && php artisan route:cache \
    && php artisan view:clear \
    && php artisan view:cache

# Create health check file
COPY health-check.php /var/www/html/health-check.php

# Expose port 8080
EXPOSE 8080

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"] 