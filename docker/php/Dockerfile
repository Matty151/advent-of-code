FROM php:8.1-fpm

RUN apt-get update -y

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get autoremove -y

# Set correct permissions
ARG UID

ENV UID=${UID}

RUN usermod -u ${UID} www-data
