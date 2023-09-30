FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Копирование кода в контейнер
COPY . /invitations
WORKDIR /invitations

EXPOSE 9000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=9000"]
