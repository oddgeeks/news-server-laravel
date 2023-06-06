FROM php:8.2.5-apache

RUN apt-get update && \
    apt-get install -y mysql-client && \
    docker-php-ext-install pdo_mysql \
    php artisan migrate \
    php artisan db:seed \
    php artisan serve


COPY . /var/www/html