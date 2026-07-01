FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN groupadd -g 1000 www && \
    useradd -u 1000 -g www -m -s /bin/bash www

COPY --chown=www:www composer.json composer.lock package.json package-lock.json vite.config.js /var/www/html/

RUN composer install --no-interaction --optimize-autoloader --no-scripts && \
    npm ci

COPY --chown=www:www . /var/www/html

RUN CACHE_STORE=array SESSION_DRIVER=array npm run build && \
    CACHE_STORE=array SESSION_DRIVER=array php artisan optimize:clear && \
    CACHE_STORE=array SESSION_DRIVER=array php artisan package:discover --ansi && \
    chown -R www:www storage bootstrap/cache

USER www

EXPOSE 9000
CMD ["php-fpm"]
