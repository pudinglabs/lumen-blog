FROM php:7.3.2-fpm-stretch

ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites
RUN apt-get update \
	&& apt-get install -y gnupg2 \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get install -y --no-install-recommends \
        locales \
        apt-transport-https \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17

RUN apt-get update && \
	apt-get install -y openssl libssl-dev pkg-config && \
    pecl channel-update pecl.php.net && \
    pecl install sqlsrv pdo_sqlsrv apcu igbinary mongodb && \
    # compile Redis with igbinary support
    pecl bundle redis && cd redis && phpize && ./configure --enable-redis-igbinary && make && make install && \
    docker-php-ext-install mbstring pdo pdo_mysql bcmath sockets && \
    docker-php-ext-enable apcu igbinary mongodb opcache redis && \
    docker-php-source delete

RUN set -x \
	addgroup -g 82 -S www-data \
	adduser -u 82 -D -S -G www-data www-data