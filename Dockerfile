FROM php:8.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-install pdo pdo_mysql
# RUN cd /var/www/html && composer create-project symfony/skeleton:"6.1.*" projectTest
COPY . /var/www/html
WORKDIR /var/www/html
EXPOSE 8080
CMD ["php-fpm"]
# COPY ./vhosts/dimitri.conf /etc/apache2/sites-available/
# RUN a2ensite dimitri.conf
# RUN /etc/init.d/apache2 restart
# RUN chmod -R 777 var/cache/dev/







