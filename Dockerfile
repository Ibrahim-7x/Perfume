FROM php:8.4.0-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    bcmath \
    xml \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80