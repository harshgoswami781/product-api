FROM php:8.1-apache

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Copy your app code into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
