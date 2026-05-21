FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
