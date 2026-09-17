# Peace Automation — PHP 8.2 + Apache
#
# Builds the site into a container so any Docker host (Railway, Render,
# Fly.io, a VPS) can run it. The database is supplied through environment
# variables — see config/db.php.

FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# mod_php only runs under prefork, and Apache refuses to start when a second
# MPM is loaded ("AH00534: More than one MPM loaded"). a2dismod is not
# reliable here, so every MPM symlink is removed and prefork is linked back
# by hand. The final ls prints the result into the build log.
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf \
 && ln -s /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load \
 && ln -s /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf \
 && a2enmod rewrite headers expires deflate \
 && echo "MPMs enabled:" && ls -1 /etc/apache2/mods-enabled/ | grep mpm

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
