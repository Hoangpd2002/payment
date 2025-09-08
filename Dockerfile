FROM php:8.4-rc-cli

# Cài thư viện hệ thống
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql gd mbstring

# Cài composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy toàn bộ source vào container
COPY . .

# Cài dependencies (bao gồm require-dev để chạy Pest/Testbench)
RUN composer install --prefer-dist --no-interaction