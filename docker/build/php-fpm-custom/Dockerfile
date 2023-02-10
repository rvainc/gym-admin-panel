FROM php:8.1-fpm

RUN curl -sL https://deb.nodesource.com/setup_16.x | sudo bash -
RUN apt-get update && apt-get install -y \
    nodejs \
    zip \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pgsql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
