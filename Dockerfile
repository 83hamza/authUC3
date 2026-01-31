
ARG CACHE_BREAKER=1


ARG CACHE_BREAKER=1
FROM php:8.3-fpm

WORKDIR /app

# 👇 هذا السطر فقط لكسر الكاش
RUN echo "CACHE BREAKER = ${CACHE_BREAKER}"

COPY . .

RUN chown -R www-data:www-data storage bootstrap/cache

RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build
