 # Use a base image with PHP and Apache
FROM php:8.2-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy PHP application code
COPY ./src /var/www/html

# If "public" is the web root, configure Apache
COPY ./apache-vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose the web server port
EXPOSE 80

