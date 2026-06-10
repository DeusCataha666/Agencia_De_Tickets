FROM php:8.2-apache

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# Extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        zip \
        mbstring \
        exif \
        bcmath \
        xml

# 🛠️ FIX 1: Desactivar MPM conflictivos y asegurar mpm_prefork (Evita el bucle de errores)
RUN a2dismod mpm_event mpm_worker || true && \
    a2enmod mpm_prefork rewrite

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# 🛠️ FIX 2: Configurar Apache para escuchar el puerto dinámico de Railway ($PORT) en lugar del 80
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g' /etc/apache2/sites-available/000-default.conf

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer primero para aprovechar cache
COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-dev \
    --optimize-autoloader \
    --no-scripts

# Copiar el resto del proyecto
COPY . .

# Permisos Laravel
RUN mkdir -p storage/logs bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Nota: Quitamos el EXPOSE 80 ya que Railway maneja el puerto mediante la variable integrada $PORT
CMD ["apache2-foreground"]