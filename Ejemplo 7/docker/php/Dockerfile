FROM php:8.2-fpm

RUN apt-get update \
  && docker-php-ext-install mysqli pdo pdo_mysql \
  && rm -rf /var/lib/apt/lists/*
