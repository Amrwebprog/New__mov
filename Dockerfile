FROM php:8.2-apache

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# تفعيل mod_rewrite لـ Laravel
RUN a2enmod rewrite

# نسخ ملفات المشروع
COPY . /var/www/html

# إعدادات Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إعداد العمل
WORKDIR /var/www/html

# تثبيت الحزم
RUN composer install

# Laravel Permissions
RUN chmod -R 775 storage bootstrap/cache
