# Using the LTS version of Node.js ~45MB
FROM node:20.11.1-alpine3.18 as install-and-build

# Environment variables
WORKDIR /app
ENV NODE_ENV=production

# Build assets (context needed, that is why we don't copy packag.json and package-lock.json alone)
COPY . .
COPY .env.docker.example .env
RUN npm install --frozen-lockfile --production --include=dev
RUN npm run build --optimize

# --------------------------------------------------------------------------------------------
# Install Laravel framework system requirements (https://laravel.com/docs/10.x/deployment)
FROM webdevops/php-nginx:8.3-alpine as base

# Environment variables
# ENV COMPOSER_ALLOW_SUPERUSER=1
ENV WEB_DOCUMENT_ROOT=/app/public/
# ENV WEB_DOCUMENT_INDEX=app/public/index.php
ENV WEB_PHP_SOCKET=127.0.0.1:80
ENV APP_ENV=production
WORKDIR /app

# Add Build Assets (js, css, json, etc.)
COPY --from=install-and-build /app .

# Copy Configuration files
COPY nginx.conf /opt/docker/etc/nginx/conf.d
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# COPY php.ini /opt/docker/etc/php/php.ini

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Optimizing Configuration loading
RUN php artisan config:cache

# Optimizing Event loading
RUN php artisan event:cache

# Optimizing Route loading
RUN php artisan route:cache

# Optimizing View loading
RUN php artisan view:cache

RUN chmod -R 755 /app/public
RUN chmod 644 /app/public/index.php
RUN chown -R application:application .

RUN php artisan optimize

EXPOSE 80
