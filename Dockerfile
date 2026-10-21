FROM php:8.4-cli

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction

COPY . .
RUN composer dump-autoload --optimize

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "index.php"]