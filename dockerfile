# -------- BUILD STAGE --------
FROM node:22 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

# Build frontend assets (vite)
RUN npm run build

# -------- PHP + Composer STAGE --------
FROM composer:2.7 AS php-builder

WORKDIR /app

# Copie code Laravel + frontend build
COPY --from=node-builder /app /app

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# -------- FINAL RUNTIME --------
FROM php:8.3-apache

WORKDIR /var/www/html

# Active mod_rewrite
RUN a2enmod rewrite

# Copie le code Laravel
COPY --from=php-builder /app /var/www/html

# Configure Apache pour pointer sur /public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory \"/var/www/html/public\">' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Copie du script d'entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
