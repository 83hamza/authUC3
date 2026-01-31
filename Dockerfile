ARG CACHE_BREAKER=3

FROM php:8.3-fpm

WORKDIR /app

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl zip nodejs npm \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# ✅ Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cache breaker (forces rebuild)
RUN echo "CACHE BREAKER = ${CACHE_BREAKER}"

# Copy project files
COPY . .

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# Clear & rebuild Laravel cache
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache
