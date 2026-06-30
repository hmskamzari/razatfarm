FROM php:8.3-cli

WORKDIR /app

# System deps + PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpng-dev libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring xml zip ctype gd intl opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node 22
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs && apt-get clean

# Copy app
COPY . .

# PHP deps
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --optimize-autoloader --no-scripts --no-interaction --no-dev

# JS deps + build
RUN npm install --ignore-scripts && npm run build && rm -rf node_modules

EXPOSE 8080

CMD php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan storage:link --force && \
    php artisan shield:generate --all --panel=admin --no-interaction && \
    php artisan permission:cache-reset && \
    php artisan shield:super-admin --user=1 --panel=admin && \
    php artisan serve --host=0.0.0.0 --port=8080
