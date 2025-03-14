FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY ../../app/composer.json .
COPY ../../app/composer.lock .

RUN composer install

EXPOSE 80
