#!/bin/bash
set -e

PORT="${PORT:-80}"
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/:80/:$PORT/" /etc/apache2/sites-available/000-default.conf

cd /var/www/html

php artisan migrate --force || echo "Migration skipped (tables may already exist)"

chown -R www-data:www-data storage bootstrap/cache

exec apache2-foreground
