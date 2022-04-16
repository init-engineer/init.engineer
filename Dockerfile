FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mariadb-client libmagickwand-dev libpng-dev \
    libonig-dev libzip-dev zip libpng-dev libjpeg-dev \
    libfreetype6-dev --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && pecl install imagick mcrypt \
    && docker-php-ext-enable imagick mcrypt \
    && docker-php-ext-install zip pdo_mysql mbstring gd \
    && rm -rf /var/lib/apt/lists/*

ENTRYPOINT ["docker-php-entrypoint"]

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8000

CMD ["php-fpm"]
