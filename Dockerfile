# Usamos una imagen que ya trae Apache y PHP
FROM php:8.2-apache

# Instalar dependencias necesarias para Symfony y MySQL
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev zlib1g-dev libzip-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Habilitar el módulo de reescritura de Apache (necesario para las rutas de Symfony)
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache para que apunte a la carpeta 'public' de Symfony
# Esto es vital: Symfony debe servir desde /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copiar el código fuente
COPY . .

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Ajustar permisos (importante para que Symfony pueda escribir en logs y caché)
RUN chown -R www-data:www-data /var/www/html/var