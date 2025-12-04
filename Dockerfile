# PHP FPM image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    && mv composer.phar /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev -o

# Generate key
RUN php artisan key:generate

# Cache config
RUN php artisan config:cache

# Storage permission
RUN chmod -R 775 storage bootstrap/cache

# Start Laravel
CMD php artisan serve --host 0.0.0.0 --port $PORT
