#!/bin/bash

chown -R www-data:www-data /var/www/app/storage
chmod -R 775 /var/www/app/storage

composer install

cp -n .env.example .env || true

php artisan key:generate --force

php artisan cache:clear

php-fpm
