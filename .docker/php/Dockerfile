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

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/www/app/storage/framework/sessions \
    && chown -R www-data:www-data /var/www/app/storage \
    && chmod -R 775 /var/www/app/storage

WORKDIR /var/www/app

COPY . /var/www/app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY .env.example .env

RUN php artisan key:generate --force

RUN php artisan cache:clear

EXPOSE 9000

CMD ["php-fpm"]
