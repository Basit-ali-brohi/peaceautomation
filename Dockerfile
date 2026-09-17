# Peace Automation — PHP 8.2 + Apache
#
# Builds the site into a container so any Docker host (Railway, Render,
# Fly.io, a VPS) can run it. The database is supplied through environment
# variables — see config/db.php.

FROM php:8.2-apache

# PDO MySQL for the app, plus the Apache modules .htaccess relies on.
RUN docker-php-ext-install pdo pdo_mysql \
 && a2enmod rewrite headers expires deflate

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
