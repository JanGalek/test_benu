FROM php:8.4-cli
RUN pecl install xdebug-3.4.4 \
	&& docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH="/root/.composer/vendor/bin:${PATH}"
WORKDIR /app