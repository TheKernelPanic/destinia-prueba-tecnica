FROM ubuntu:20.04

MAINTAINER "Jorge García"

ENV PHP_VERSION=8.1

# Install PHP & extensions & composer
RUN apt update && \
    apt install software-properties-common curl git locales -y && \
    add-apt-repository ppa:ondrej/php && \
    apt update && \
    apt install -y php$PHP_VERSION php$PHP_VERSION-common php$PHP_VERSION-cli php$PHP_VERSION-dev php$PHP_VERSION-mbstring php$PHP_VERSION-mysql && \
    cd ~ && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    mkdir /usr/share/destinia-prueba-tecnica

# Locales configuration
RUN locale-gen es_ES && \
    locale-gen en_EN
