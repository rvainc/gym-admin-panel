FROM php:7-cli

RUN apt-get update && apt-get install -y \
    dos2unix \
    libpq-dev \
    && docker-php-ext-install pdo pgsql pdo_pgsql

COPY start-queue /usr/local/bin/

RUN dos2unix /usr/local/bin/start-queue \
    && chmod +x /usr/local/bin/start-queue \
    && apt-get --purge remove -y dos2unix \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

ENTRYPOINT ["start-queue"]

CMD []