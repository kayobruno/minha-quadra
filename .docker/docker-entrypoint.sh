#!/bin/bash

composer install

cp .env.example .env

php artisan key:generate
php artisan cache:clear

php-fpm

exec "$@"
