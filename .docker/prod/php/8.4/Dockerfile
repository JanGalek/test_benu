FROM php:8.4-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH="/root/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

RUN mkdir -p /var/www/html/temp /var/www/html/log \
    && chmod -R 775 /var/www/html/temp /var/www/html/log

RUN chown -R www-data:www-data /var/www/html/temp /var/www/html/log
USER www-data

CMD ["php-fpm"]
