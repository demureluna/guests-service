FROM php:8.1.0-fpm-alpine3.14

WORKDIR /var/www/application

RUN set -xe \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_mysql

COPY . .
 
EXPOSE 9000
CMD ["php-fpm"]