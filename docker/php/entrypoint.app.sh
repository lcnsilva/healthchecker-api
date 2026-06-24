#!/bin/sh
# Exits immediately if any command fails.
set -e

# Ensures database-backed Laravel infrastructure exists before workers start.
# php artisan migrate --force

# Marks the app as bootstrapped for Docker healthchecks.
# touch /tmp/healthchecker-app-ready

# Starts PHP-FPM for the HTTP application.
exec php-fpm
