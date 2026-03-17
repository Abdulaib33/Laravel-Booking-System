FROM php:8.4-cli


# Install system dependencies needed by Laravel + Composer
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Render provides $PORT
EXPOSE 10000

CMD php artisan serve --host 0.0.0.0 --port ${PORT}





# # THIS TIME WE ARE DEPLOYING TO RAILWAY AND THIS WILL BE OUR DOCKERFILe THIS TIME :
    
# # FROM php:8.3-apache  we are going to use the FROM below, because previously it worked fine
# FROM php:8.4-cli

# # System packages + PHP extensions needed by Laravel
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     libzip-dev \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     libicu-dev \
#     libpq-dev \
#     default-mysql-client \
#     curl \
#     && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl intl \
#     && a2enmod rewrite \
#     && rm -rf /var/lib/apt/lists/*

# # Set Apache document root to Laravel public/
# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
#     /etc/apache2/sites-available/*.conf \
#     /etc/apache2/apache2.conf \
#     /etc/apache2/conf-available/*.conf

# # Install Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www/html

# # Copy app files
# COPY . .

# # Install PHP dependencies
# RUN composer install --no-dev --optimize-autoloader --no-interaction

# # Permissions for Laravel
# RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
#     && chown -R www-data:www-data storage bootstrap/cache

# # Optional: build frontend assets only if package.json exists
# RUN if [ -f package.json ]; then \
#       curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
#       apt-get update && apt-get install -y nodejs && \
#       npm install && npm run build && \
#       rm -rf node_modules /root/.npm /var/lib/apt/lists/*; \
#     fi

# # Apache listens on 80 inside container
# EXPOSE 80