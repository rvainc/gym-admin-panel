FROM php:7-cli

RUN apt-get update && apt-get install -y \
# install cron
    cron \
    dos2unix \
    libpq-dev \
    # making logging pipe
    && mkfifo --mode 0666 /var/log/cron.log \
    && docker-php-ext-install pdo pgsql pdo_pgsql

COPY start-cron /usr/local/bin/
COPY crontab /etc/cron.d/laravel

RUN dos2unix /usr/local/bin/start-cron \
    && dos2unix /etc/cron.d/laravel \
    && chmod +x /usr/local/bin/start-cron \
    && crontab /etc/cron.d/laravel \
    && apt-get --purge remove -y dos2unix \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

ENTRYPOINT ["start-cron"]

CMD []