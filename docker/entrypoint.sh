#!/bin/sh
# Starts Apache on the port the platform assigns, after making sure the
# database tables exist.
set -e

# ---------------------------------------------------------------
# Exactly one MPM. mod_php only runs under prefork, and Apache aborts
# with "AH00534: More than one MPM loaded" if a second one is enabled.
# This is done here rather than in the Dockerfile so the state Apache
# actually starts with is the state we set, and it is printed below.
# ---------------------------------------------------------------
rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
if [ -f /etc/apache2/mods-available/mpm_prefork.conf ]; then
  ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf
fi
echo "[boot] mods-enabled MPM entries:"
ls -la /etc/apache2/mods-enabled/ | grep -i mpm || echo "[boot]   (none)"

PORT="${PORT:-80}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

echo "[boot] applying database schema…"
php /var/www/html/config/migrate.php || echo "[boot] schema step failed — the site will still start"

echo "[boot] Apache listening on ${PORT}"
exec apache2-foreground
