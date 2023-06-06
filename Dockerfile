FROM php:8.2.5-apache

RUN apt-get update && \
    apt-get install -y mysql-client && \
    docker-php-ext-install pdo_mysql

COPY . /var/www/html