#!/bin/sh
# Exits immediately if any command fails.
set -e

# Starts Laravel's scheduler loop for local/container execution.
php artisan schedule:work
