FROM php:8.2.4-apache

WORKDIR /var/www/html

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli pdo pdo_mysql && \
  echo "display_errors=On" >> /usr/local/etc/php/conf.d/docker-php-dev.ini && \
  echo "display_startup_errors=On" >> /usr/local/etc/php/conf.d/docker-php-dev.ini && \
  echo "error_reporting=E_ALL" >> /usr/local/etc/php/conf.d/docker-php-dev.ini

EXPOSE 80