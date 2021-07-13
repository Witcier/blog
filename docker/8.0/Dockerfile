FROM php:8.0.8-fpm

RUN usermod -u 1000 www-data

WORKDIR /var/www/html

RUN apt-get update \
&& apt-get install -y \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    supervisor \
    python2 \
&& curl -so /usr/bin/composer https://mirrors.aliyun.com/composer/composer.phar \
&& chmod a+x /usr/bin/composer \
&& composer --version \
&& curl -sL https://deb.nodesource.com/setup_16.x | bash - \
&& apt-get install -y nodejs \
&& curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
&& apt-get update \
&& apt-get install -y yarn \
&& docker-php-ext-install -j$(nproc) gd \
&& docker-php-ext-install mysqli pdo_mysql \
&& pecl install swoole \
&& pecl install redis \
&& docker-php-ext-install pcntl \
&& apt-get install -y zlib1g-dev \
&& apt-get install -y libzip-dev \
&& apt-get install -y zip unzip \
&& docker-php-ext-install zip \
&& docker-php-ext-configure gd --with-webp=/usr/include/webp --with-jpeg=/usr/include --with-freetype=/usr/include/freetype2 \
&& docker-php-ext-install gd \
&& docker-php-ext-enable swoole redis pcntl zip gd

COPY php.ini /usr/local/etc/php/php.ini
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD supervisord -c  /etc/supervisor/supervisord.conf \
    & php-fpm