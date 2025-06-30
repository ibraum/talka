#!/bin/bash

# Si le .env n’existe pas, on le crée à partir de l’exemple
if [ ! -f /var/www/html/.env ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

# Génère la clé si absente
php artisan key:generate --force

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migrations (si base up)
php artisan migrate --seed --force || true

# Permissions
chmod -R 775 storage bootstrap/cache

exec "$@"
