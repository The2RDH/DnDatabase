FROM php:8.2-fpm

# Instalar Nginx y dependencias
RUN apt-get update && apt-get install -y \
    nginx git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Copiar configuración de Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Instalar dependencias
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

# Configurar permisos
RUN mkdir -p var/cache var/log && chown -R www-data:www-data var

# Exponer puerto 80
EXPOSE 80

# Comando para arrancar ambos servicios: Nginx y PHP-FPM
CMD service nginx start && php-fpm