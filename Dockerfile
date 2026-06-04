FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# --- LIMPIEZA DRÁSTICA DE MÓDULOS ---
# Desinstalamos cualquier MPM instalado para evitar el conflicto
RUN apt-get remove -y apache2-mpm-event apache2-mpm-worker || true && \
    apt-get install -y apache2-mpm-prefork && \
    a2enmod mpm_prefork
# ------------------------------------

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --no-scripts --no-interaction --optimize-autoloader

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Aseguramos la creación de las carpetas y permisos
RUN mkdir -p /var/www/html/var/cache /var/www/html/var/log && \
    chown -R www-data:www-data /var/www/html/var

EXPOSE 80