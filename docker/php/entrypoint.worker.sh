#!/bin/sh
# Exits immediately if any command fails.
set -e

# Starts Laravel's Redis queue worker.
# Uses redis as the queue connection.
# Waits 3 seconds before checking again when no job is available.
# Tries each failed job up to 3 times before marking it failed.
# Kills a job if it runs longer than 90 seconds.
# Restarts the worker when memory usage reaches 256 MB.
php artisan queue:work redis --sleep=3 --tries=3 --timeout=90 --memory=256
