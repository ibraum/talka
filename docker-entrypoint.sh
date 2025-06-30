#!/bin/bash

set -e

# Copie .env si absent
if [ ! -f /var/www/html/.env ]; then
  cp /var/www/html/.env.example /var/www/html/.env

  # Ajoute clé temporaire si absente
  sed -i "s|^APP_KEY=.*|APP_KEY=base64:PLACEHOLDER|" /var/www/html/.env
fi

# Génère clé si absente
php artisan key:generate --force || true

# Clear caches
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Rebuild caches
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Exécute migrations et seed (optionnel)
php artisan migrate --seed --force || true

# Droits
chmod -R 775 storage bootstrap/cache

exec "$@"
