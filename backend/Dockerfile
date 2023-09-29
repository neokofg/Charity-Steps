FROM php:8.2.0
RUN apt-get update && apt-get install -y \
                          libpq-dev \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install \
      pcntl
RUN apt-get install -y gcc g++ autoconf
RUN pecl install swoole && docker-php-ext-enable swoole
COPY . /server
WORKDIR /server
CMD ["php", "artisan", "octane:start", "--host=0.0.0.0"]
