FROM php:8.4-apache-bookworm

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
       build-essential \
       vim wget \
       dialog \
       git \
       libxml2-dev \
       libicu-dev \
       zlib1g-dev zip unzip \
        g++ \
	&& rm -rf /var/lib/apt/lists/*

RUN apt-get update -y

# Install ZIP
RUN apt-get install libz-dev libzip-dev -y
RUN pecl install zlib zip

#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip


# Install Mcrypt
RUN apt-get update \
    && apt-get install -y libmcrypt-dev \
    && pecl install mcrypt \
    && docker-php-ext-enable mcrypt

# Install CURL
RUN apt-get update && apt-get install -y curl

# Install DOM
RUN docker-php-ext-install dom

# Install Fileinfo
RUN docker-php-ext-install fileinfo

# Install GD library
RUN #apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && docker-php-ext-install gd

RUN apt-get update -y && \
    apt-get install -y zlib1g-dev libpng-dev libjpeg-dev
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd

# Instalar Filter
RUN apt-get update && apt-get install -y libxml2-dev && docker-php-ext-install filter

# Install OpenSSL
RUN apt-get -y update && \
    apt-get -y --no-install-recommends install --fix-missing libcurl4 \
    libcurl4-openssl-dev \
    openssl && \
    rm -rf /var/lib/apt/lists/*

# Install PDO & PDO(MySQL)
RUN docker-php-ext-install pdo
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql
RUN docker-php-ext-install -j$(nproc) pdo_mysql


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/local/bin/ \
        && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Install CTYPE
RUN docker-php-ext-configure ctype --enable-ctype
RUN docker-php-ext-install ctype
RUN docker-php-ext-enable ctype

RUN curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s  \
    xdebug mbstring hash pcre bcmath soap gettext opcache simplexml mysqli intl iconv json

#Install SSL Cert
RUN apt-get update
RUN apt-get install -y ssl-cert

# Setup Apache2 mod_ssl
RUN a2enmod ssl
RUN a2enmod rewrite
RUN a2enmod headers

# Setup Apache2 HTTPS env
RUN mkdir -p /etc/apache2/ssl
COPY ./config/php/php.ini /usr/local/etc/php/conf.d/php.ini

COPY ./config/ssl/cert.pem /etc/apache2/ssl/cert.pem
COPY ./config/ssl/key.pem /etc/apache2/ssl/key.pem
COPY ./config/apache/default.conf /etc/apache2/sites-enabled/000-default.conf

RUN update-ca-certificates

EXPOSE 80
EXPOSE 443

# Clean up
RUN apt-get autoremove -y && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install node 16
RUN apt update -y
RUN apt-get install -y ca-certificates curl gnupg
RUN mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_16.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list
RUN apt-get update -y
RUN apt-get install nodejs -y

# Apache configuration
RUN usermod -u 1000 www-data

RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/

