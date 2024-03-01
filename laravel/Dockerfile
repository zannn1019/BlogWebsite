FROM dunglas/frankenphp:1.0.3-php8.2

RUN apt-get update && apt-get install -y libpq-dev curl libpng-dev libonig-dev libxml2-dev openssl zip git libzip-dev libmagickwand-dev \
    && docker-php-ext-install pdo pdo_pgsql pcntl sockets zip gd \
    && pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/laravel-app
COPY . .

RUN composer install

EXPOSE 8000
CMD php artisan storage:link && php artisan key:generate && php artisan octane:frankenphp
