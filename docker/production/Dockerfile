ARG PHP_VERSION=8.5

FROM php:${PHP_VERSION}-fpm-bookworm AS phpbase
RUN apt-get update && apt-get install -y --no-install-recommends \
      ca-certificates git unzip libicu-dev libzip-dev \
      libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j1 pdo_mysql bcmath intl zip gd mbstring exif opcache pcntl \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html

# Dependencias Laravel sin instalar paquetes de desarrollo.
FROM phpbase AS vendor
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress \
      --no-scripts --optimize-autoloader

# Assets Vite 8 con Node >=22.12. Debe incluir vendor para @source de Tailwind.
FROM node:22-bookworm-slim AS assets
WORKDIR /build
COPY package.json package-lock.json .npmrc ./
RUN npm ci --no-audit --no-fund
COPY . .
COPY --from=vendor /var/www/html/vendor ./vendor
RUN npm run build

FROM phpbase AS app
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY --from=vendor /var/www/html/vendor ./vendor
COPY . .
COPY --from=assets /build/public/build ./public/build
COPY docker/production/php.ini /usr/local/etc/php/conf.d/99-production.ini
COPY docker/production/www.conf /usr/local/etc/php-fpm.d/zz-production.conf
RUN mkdir -p storage/app/public storage/app/private storage/framework/cache/data \
      storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && composer dump-autoload --no-dev --optimize --no-scripts \
    && php artisan package:discover --ansi \
    && php artisan filament:assets --no-interaction \
    && rm -f public/hot \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache
EXPOSE 9000
CMD ["php-fpm"]

FROM caddy:2-alpine AS web
COPY docker/production/Caddyfile /etc/caddy/Caddyfile
COPY --from=app /var/www/html/public /var/www/html/public
