#!/bin/bash

# Fix permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

php /var/www/artisan make:filament-user --email=jaahumad@gmail.com --password=Automatizalofome1 --name="jaahumad"
# Then exec the container's main process (what's set as CMD in the Dockerfile)
exec "$@"