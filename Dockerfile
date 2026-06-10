FROM php:8.2-cli

# Instalar dependencias del sistema y extensiones de PHP necesarias para MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-install pdo_mysql mbstring

# Traer Composer de forma directa
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html
COPY . .

# Instalar dependencias de Laravel sin las de desarrollo
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Dar permisos correctos a las carpetas de almacenamiento de Laravel
RUN chmod -R 775 storage bootstrap/cache

# Comando de arranque usando el puerto dinámico de Railway
CMD php artisan serve --host=0.0.0.0 --port=${PORT}