FROM php:8-apache

RUN apt-get update && docker-php-ext-install \
        mysqli \
        pdo_mysql \
    && docker-php-ext-enable \
        mysqli \
        pdo_mysql

RUN a2enmod rewrite        