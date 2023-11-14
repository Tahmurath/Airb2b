FROM php:8.2-fpm

#ARG WITH_XDEBUG=true

RUN apt-get update && apt-get install -y libzip-dev libpq-dev libicu-dev
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-devlibpng-dev
RUN apt-get -y install git
RUN apt-get -y install vim
RUN apt-get -y install wget
#RUN git config --global user.email "hamidreza.tahmooresi@gmail.com"
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure zip
RUN docker-php-ext-install -j$(nproc) zip pdo_pgsql intl
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install xdebug;

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get install -y symfony-cli

#WORKDIR /app/

COPY . .


