FROM php:8.2-cli

RUN apt-get update && apt-get install -y libpq-dev curl libpng-dev libonig-dev libxml2-dev openssl && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html/laravel-app
COPY . .

RUN composer install

EXPOSE 8000
CMD php artisan storage:link && php artisan serve --host=0.0.0.0 --port=8000
