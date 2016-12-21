FROM library/nginx:alpine

COPY ./nginx/conf.d/* /etc/nginx/conf.d/
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

COPY ./certs /data/certs

RUN mkdir -p /var/www
VOLUME /var/www
