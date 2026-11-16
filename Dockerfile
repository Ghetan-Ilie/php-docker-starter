FROM php:8.3-apache

# PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

WORKDIR /var/www/html
