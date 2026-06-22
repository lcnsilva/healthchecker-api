# Uses the official PHP 8.5 FPM image on Alpine Linux as the base.
FROM php:8.5-fpm-alpine

# Defines the host user id used to create the non-root container user.
ARG UID=1000
# Defines the host group id used to create the non-root container group.
ARG GID=1000

# Sets the default working directory for build and runtime commands.
WORKDIR /var/www/html

# Installs Alpine packages required by Laravel, Composer, PostgreSQL, and PHP extensions.
RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libzip-dev \
    postgresql-dev \
    unzip \
    zip \
  && docker-php-ext-install \
    bcmath \
    intl \
    pcntl \
    pdo_pgsql \
    zip

# Copies Composer from the official Composer image into this PHP image.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Creates a non-root group and user for safer local container execution.
RUN addgroup -g ${GID} appgroup \
  && adduser -D -u ${UID} -G appgroup appuser

# Copies custom PHP settings into PHP's conf.d directory.
COPY docker/php/php.ini /usr/local/etc/php/conf.d/healthchecker.ini

# Switches runtime execution from root to the non-root application user.
USER appuser

# Starts PHP-FPM by default for the app service.
CMD ["php-fpm"]
