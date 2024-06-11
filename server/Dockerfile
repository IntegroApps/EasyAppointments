# # Utiliza una imagen base de PHP con Apache
# FROM php:8.2-apache

# # Instala extensiones necesarias de PHP
# RUN apt-get update && apt-get install -y \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli

# # Habilita mod_rewrite de Apache
# RUN a2enmod rewrite

# # Copia los archivos del proyecto al directorio raíz de Apache
# COPY . /var/www/html

# # Crear los directorios si no existen y establece permisos adecuados
# RUN mkdir -p /var/www/html/storage \
#     && mkdir -p /var/www/html/uploads \
#     && mkdir -p /var/www/html/tmp \
#     && chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html/storage \
#     && chmod -R 755 /var/www/html/uploads \
#     && chmod -R 755 /var/www/html/tmp

# # Instala Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Ejecuta Composer para instalar las dependencias del proyecto
# RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# # Expone el puerto 80 para acceso HTTP
# EXPOSE 80

# # Comando para iniciar Apache
# CMD ["apache2-foreground"]

FROM php:8.2-apache

WORKDIR "/var/www/html"

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd gettext mysqli pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite