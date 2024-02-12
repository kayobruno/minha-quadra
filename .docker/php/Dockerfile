FROM php:8.2-fpm@sha256:dab0a1456cbcce4a7b19b541474a7a77cd1de8a5998fa3aab2ee52dee132b86e

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    unzip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_mysql

COPY . /var/www/app
WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app \
    && chmod -R 775 /var/www/app/storage

COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer

COPY composer.json ./
RUN composer install

CMD ["php-fpm"]
