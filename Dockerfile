FROM php:8.2-cli

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

# Extensiones PHP (Tus mismas extensiones para que Laravel funcione perfecto)
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

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar archivos de dependencias para aprovechar la caché de Docker
COPY composer.json composer.lock ./

RUN composer install \
    --no-interaction \
    --no-dev \
    --optimize-autoloader \
    --no-scripts

# Copiar el resto de tu proyecto de Laravel
COPY . .

# Configurar permisos correctos para Laravel
RUN mkdir -p storage/logs bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 🚀 COMANDO MAESTRO: Arranca el servidor nativo de PHP usando el puerto dinámico de Railway
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public"]