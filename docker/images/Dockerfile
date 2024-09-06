# Usar PHP 8.3 FPM como base
FROM php:8.3-fpm as base

# Instalar extensiones de PHP necesarias para Laravel
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Configurar el directorio de trabajo
WORKDIR /var/www/html

EXPOSE 9000

FROM base as dev
RUN composer global require laravel/installer
ENV PATH="$PATH:/root/.composer/vendor/bin"

FROM base as prod
CMD ["php-fpm"]
