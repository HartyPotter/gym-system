# Use an official PHP runtime with Apache as the base image
FROM php:8.2-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    git \
    curl

# Install PHP extensions required by Laravel
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd

# Install Node.js and npm (for Laravel Mix)
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Install Composer (PHP dependency manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy only the composer files first
COPY composer.json composer.lock ./

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy the rest of the application code
COPY . .

# Copy .env.example as .env
COPY .env .env

# Generate Laravel application key
RUN php artisan key:generate

# Run Composer scripts (e.g., package discovery)
RUN composer run-script post-autoload-dump

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Install Node.js dependencies
RUN npm install

# Build frontend assets for production
RUN npm run build

# Create symbolic link for storage
RUN php artisan storage:link

# Set permissions for the web server
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for Apache
EXPOSE 8080

# Start Apache in the foreground
CMD ["apache2-foreground"]