FROM php:8.4-alpine AS php-build

ENV PHPIZE_DEPS \
		autoconf \
		file \
		g++ \
		gcc \
		libc-dev \
		make \
		pkgconf \
		re2c

RUN apk add --no-cache shadow

# install the PHP extensions we need
RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
	&& docker-php-ext-configure gd \
	&& docker-php-ext-install -j$(nproc) gd \
	&& docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) zip

RUN runDeps="$( \
       scanelf --needed --nobanner --recursive /usr/local /usr/lib \
    		| awk '{ gsub(/,/, "\nso:", $2); print "so:" $2 }' \
    		| sort -u \
    		| xargs -r apk info --installed \
    		| sort -u \
    )" \
  && apk del .build-deps \
  && apk add --no-cache --virtual .php-custom-rundeps $runDeps

################################################################################
FROM php:8.4-alpine
COPY --from=php-build /usr /usr
COPY --from=php-build /etc /etc
COPY --from=php-build /lib /lib
COPY --from=php-build /bin /bin
COPY --from=php-build /sbin /sbin
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1

WORKDIR /app
COPY composer.json ./
RUN composer install
COPY . .

CMD composer build
