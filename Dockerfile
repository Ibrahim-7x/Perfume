# Stage 0: Build
FROM php:8.4-apache AS laravel-build

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring xml zip bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application files
COPY . .

# Copy composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies (production)
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Update Apache DocumentRoot to Laravel public folder
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Clear Laravel caches
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]