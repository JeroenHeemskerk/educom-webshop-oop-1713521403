FROM php:8.3-rc-apache
RUN apt-get update && docker-php-ext-install pdo_mysql
COPY . /var/www/html/