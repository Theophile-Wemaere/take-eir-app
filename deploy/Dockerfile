FROM php:8.0-apache
COPY . /var/www/html
#COPY deploy/php.ini /usr/local/etc/php/conf.d/
RUN docker-php-ext-install mysqli pdo pdo_mysql
WORKDIR /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
