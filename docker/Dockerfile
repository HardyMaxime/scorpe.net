# Stage 1 : compilation des assets
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
COPY assets/ ./assets/
RUN mkdir -p web/app/themes/colibrys/assets/dist
RUN npm ci && npm run build

# Stage 2 : application
FROM dunglas/frankenphp:php8.4-alpine

RUN apk --no-cache add curl bash

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    opcache \
    mysqli \
    gd \
    exif \
    zip

# Configuration PHP recommandée pour WordPress
RUN echo "upload_max_filesize = 64M" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/memory.ini

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Installation de WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader

COPY . .
COPY --from=assets /app/web/app/themes/colibrys/assets/dist/ ./web/app/themes/colibrys/assets/dist/
RUN composer dump-autoload --optimize

COPY docker/Caddyfile /etc/frankenphp/Caddyfile

RUN chown -R www-data:www-data /var/www/web
RUN chmod -R 755 /var/www/web
