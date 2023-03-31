FROM php:7.4-fpm
WORKDIR /var/www/html
COPY . /var/www/html
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-install zip
EXPOSE 9000
CMD ["php-fpm"]

