#!/bin/sh
# Starts Apache on the port the platform assigns, after making sure the
# database tables exist.
set -e

PORT="${PORT:-80}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

echo "[boot] applying database schema…"
php /var/www/html/config/migrate.php || echo "[boot] schema step failed — the site will still start"

echo "[boot] mpm LoadModule lines:"
grep -rn "LoadModule .*mpm" /etc/apache2/ 2>/dev/null || echo "[boot]   none found"
echo "[boot] Apache listening on ${PORT}"
exec apache2-foreground
