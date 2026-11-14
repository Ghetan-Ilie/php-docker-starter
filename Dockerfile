FROM php:8.3-apache

# Extensii PHP pentru MySQL (mysqli + PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# mod_rewrite pentru URL-uri curate (opțional, dar util)
RUN a2enmod rewrite

WORKDIR /var/www/html
