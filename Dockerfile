FROM webdevops/php-nginx:8.2-alpine

ENV WEB_DOCUMENT_ROOT=/var/www/public
ENV PHP_DISPLAY_ERRORS=1
ENV PHP_MEMORY_LIMIT=2048M
ENV PHP_MAX_EXECUTION_TIME=-1

WORKDIR /var/www/

ENV TZ="Asia/Tashkent"

RUN apk --no-cache add nodejs npm 