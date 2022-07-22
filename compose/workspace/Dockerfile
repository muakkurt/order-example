FROM php:8.1-fpm-alpine

COPY ./compose/workspace/run.sh /tmp

WORKDIR /var/www/html

ENTRYPOINT ["/tmp/run.sh"]