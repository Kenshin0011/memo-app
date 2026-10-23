FROM php:8.3.36-fpm

# composer create-project laravel/laravel . に必要
RUN apt-get update \
    && apt-get install -y --no-install-recommends git zip unzip \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/archives/*

# MySQLドライバ
RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 9000
