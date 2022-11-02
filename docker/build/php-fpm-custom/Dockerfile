FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    zip \
    libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pgsql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
