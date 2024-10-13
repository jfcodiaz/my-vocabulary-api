# Usar PHP 8.3 FPM como base
FROM php:8.3-fpm AS base

# Instalar extensiones de PHP necesarias para Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    curl \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    locales \
    openssh-client \
    unzip \
    vim \
    zip \
    && apt-get clean \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen en_US.UTF-8 && \
    update-locale LANG=en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Configurar el directorio de trabajo
WORKDIR /var/www/html

EXPOSE 9000

FROM base AS dev

ENV PATH="$PATH:/root/.composer/vendor/bin"
RUN \
    # Install Laravel CLI, PHP_CodeSniffer and Xdebug
    composer global require laravel/installer \
    # Install PHP_CodeSniffer
    && composer global require "squizlabs/php_codesniffer=*"  \
    # Install PHPUnit
    && composer global require phpunit/phpunit \
    # Install Xdebug
    && pecl install xdebug && docker-php-ext-enable xdebug \
    #
    # Configure Xdebug for coverage in the php.ini file
    && echo "xdebug.mode = coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request = no" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

FROM base AS prod
USER user
CMD ["php-fpm"]
