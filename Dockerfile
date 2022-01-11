FROM php:7.4-apache
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "date.timezone='Europe/Prague'" >>$PHP_INI_DIR/php.ini
#RUN pecl install pdo_pgsql \
#    && docker-php-ext-enable pdo_pgsql
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql \
    && docker-php-ext-enable pgsql
#RUN sed -e "s/;extension=pgsql/extension=pgsql/g" -i "$PHP_INI_DIR/php.ini"
COPY src/ /var/www/html/
