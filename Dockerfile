FROM php:7.1.26-cli

RUN apt-get update
RUN apt-get install --no-install-recommends -y git-core unzip
RUN pecl install xdebug-2.5.0 && docker-php-ext-enable xdebug

COPY --from=composer:1.8 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app