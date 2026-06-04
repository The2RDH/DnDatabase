FROM php:8.2-apache
RUN apt-get update && apt-get install -y git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip
RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
# AÑADIMOS ESTO PARA VER QUÉ PASA
RUN echo "Probando si composer funciona..." && composer --version