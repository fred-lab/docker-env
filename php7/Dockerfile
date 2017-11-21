FROM php:7-fpm

# Installation et mise à jours de PHP et ses librairies.
RUN apt-get update && apt-get install -y \
		libsqlite3-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libicu-dev \
        libcurl4-openssl-dev

# Installation des extensions PHP
RUN docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install json \
    && docker-php-ext-install ctype \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install posix \
    && docker-php-ext-install curl \
    && docker-php-ext-install zip



# Installation des drivers PDO pour la database
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql.so

# Installation et activation de Intl
RUN docker-php-ext-install intl \
    && docker-php-ext-enable intl.so 

# Modification des droits d'utilisateurs et de groupes
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data 

# Installation Git
RUN apt-get -y install git

# Installation Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
RUN composer self-update

# Installation Xdebug
RUN pecl install xdebug 
 
# Switch sur l'user www-data pour avoir les droits sur les fichiers
USER www-data

# Suppression des fichiers dans conf.d
#RUN rm -rvf /usr/local/etc/php/conf.d \
#    && mkdir -v /usr/local/etc/php/conf.d

# Dossier racine de travail lors de l'ouverture de la console
WORKDIR /var/www

CMD ["php-fpm"]

# Ouverture du port 9000 pour accéder à PHP
EXPOSE 9000

# Ouverture du port 10000 pour accéder à xdebug
EXPOSE 10000