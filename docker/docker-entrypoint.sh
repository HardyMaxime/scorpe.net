#!/bin/bash
chown -R www-data:www-data /var/www/web/app/uploads
php-fpm --daemonize
caddy run --config /etc/caddy/Caddyfile --adapter caddyfile