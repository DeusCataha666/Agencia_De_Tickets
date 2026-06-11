FROM dunglas/frankenphp:1-php8.2

# Instalar dependencias del sistema indispensables
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    && install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip

# Traer Composer de forma directa
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html
COPY . .

# Instalar dependencias de Laravel en limpio
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Dar permisos correctos a las carpetas clave de Laravel
RUN chmod -R 775 storage bootstrap/cache public

# Indicarle a FrankenPHP que use la carpeta public como la raíz real de la web
CMD ["frankenphp", "php-server", "--listen", ":$PORT", "--root", "public/"]