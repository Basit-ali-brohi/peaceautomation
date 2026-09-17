# Peace Automation — PHP 8.2 + Apache
#
# Builds the site into a container so any Docker host (Railway, Render,
# Fly.io, a VPS) can run it. The database is supplied through environment
# variables — see config/db.php.

FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# The base image already loads the MPM that mod_php needs from its own
# config, while Debian's mods-enabled still carries one too — two
# LoadModule lines, and Apache refuses to start ("AH00534: More than one
# MPM loaded"). Dropping the mods-enabled symlinks leaves exactly one.
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf \
 && a2enmod rewrite headers expires deflate \
 && echo "--- LoadModule mpm lines after cleanup ---" \
 && (grep -rn "LoadModule .*mpm" /etc/apache2/ 2>/dev/null || echo "none in /etc/apache2")

# Production PHP defaults: errors to the log, never to the visitor.
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/app.ini"

# Let .htaccess work and pass the platform's environment through to PHP.
COPY docker/apache-app.conf /etc/apache2/conf-available/app.conf
RUN a2enconf app

COPY . /var/www/html/

# Files the app writes at runtime (newsletter CSV, order log).
RUN mkdir -p /var/www/html/storage \
 && chown -R www-data:www-data /var/www/html/storage

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
# Strip any carriage returns a Windows checkout may have left, then make
# the script executable.
RUN sed -i 's/\r$//' /usr/local/bin/entrypoint.sh \
 && chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
CMD ["/usr/local/bin/entrypoint.sh"]
