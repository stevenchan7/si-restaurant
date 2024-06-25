# Use an official PHP runtime as a parent image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    supervisor \
    nginx

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Copy nginx and supervisor configuration files
COPY .conf/nginx.conf /etc/nginx/nginx.conf
COPY .conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 80
EXPOSE 80

# Generate APP_KEY
RUN cp .env.example .env && php artisan key:generate

# Start Supervisor
CMD ["/usr/bin/supervisord"]
