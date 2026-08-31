FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    procps \
    && docker-php-ext-install pdo pdo_mysql zip

RUN groupadd -g ${GID} appuser && useradd -u ${UID} -g appuser -m appuser

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

USER appuser

EXPOSE 9000