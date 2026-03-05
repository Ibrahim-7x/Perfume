# ============================================================
# Stage 1: Build frontend assets (Vite + Tailwind CSS)
# ============================================================
FROM node:20-alpine AS frontend-build

WORKDIR /app

# Copy package files first for better caching
COPY package.json package-lock.json* ./

# Install Node dependencies
RUN npm ci

# Copy frontend source files needed for build
COPY vite.config.js ./
COPY resources ./resources

# Build production assets
RUN npm run build

# ============================================================
# Stage 2: PHP / Apache — final production image
# ============================================================
FROM php:8.4-apache

WORKDIR /var/www/html

# ---- System dependencies & PHP extensions -------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        curl \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo pdo_mysql mbstring xml zip bcmath gd opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# ---- Apache configuration ----------------------------------
RUN a2enmod rewrite headers

# Point DocumentRoot to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/*.conf \
        /etc/apache2/apache2.conf

# Allow .htaccess overrides
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' \
        /etc/apache2/apache2.conf

# ---- PHP production settings --------------------------------
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# OPcache tuning
RUN echo "opcache.enable=1\n\
opcache.memory_consumption=128\n\
opcache.interned_strings_buffer=16\n\
opcache.max_accelerated_files=10000\n\
opcache.validate_timestamps=0\n" > /usr/local/etc/php/conf.d/opcache.ini

# Upload / POST limits (useful for perfume images)
RUN echo "upload_max_filesize=20M\n\
post_max_size=25M\n\
memory_limit=256M\n" > /usr/local/etc/php/conf.d/uploads.ini

# ---- Composer ------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files first for better Docker layer caching
COPY composer.json composer.lock* ./

# Install PHP dependencies (production only)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# ---- Application source code --------------------------------
COPY . .

# Copy built frontend assets from Stage 1
COPY --from=frontend-build /app/public/build ./public/build

# Finish composer (generate autoload, run post-scripts)
RUN composer dump-autoload --optimize \
    && composer run-script post-autoload-dump

# ---- Storage & permissions -----------------------------------
RUN mkdir -p storage/logs \
             storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Create storage symlink
RUN php artisan storage:link || true

# ---- Entrypoint script (handles Render's PORT env var) -------
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Render injects PORT (default 10000) — expose it
EXPOSE 10000

ENTRYPOINT ["docker-entrypoint.sh"]