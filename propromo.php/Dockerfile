# Using the LTS version of Node.js ~45MB
FROM node:20.11.1-alpine3.18 as install-and-build

# Environment variables
# npm ERR! Tracker "idealTree" already exists => npm i ERRORs, if there is not WORKDIR...
WORKDIR /app
ENV NODE_ENV=production

# Build assets (context needed, that is why we don't copy packag.json and package-lock.json alone)
COPY . /app
COPY .env.docker.example /app/.env
RUN npm install --frozen-lockfile --omit=dev --include=dev
RUN npm run build --optimize

# --------------------------------------------------------------------------------------------
# Install Laravel framework system requirements (https://laravel.com/docs/10.x/deployment)
FROM dunglas/frankenphp:1.1.0-php8.2.16-alpine as base

ARG USER=www-data

RUN \
	# Use "adduser -D ${USER}" for alpine based distros
	useradd -D ${USER}; \
	# Add additional capability to bind to port 80 and 443
	setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp; \
	# Give write access to /data/caddy and /config/caddy
	chown -R ${USER}:${USER} /data/caddy && chown -R ${USER}:${USER} /config/caddy;

USER ${USER}

ENV APP_ENV=production

# Add Build Assets (js, css, json, etc.)
COPY --from=install-and-build /app /app

# Install PHP and required extensions
RUN apk update
RUN apk add --no-cache php82-session
RUN install-php-extensions \
	zip \
    tokenizer

# Install PHP dependencies
RUN apk add --no-cache composer
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

RUN php artisan optimize

EXPOSE 80
