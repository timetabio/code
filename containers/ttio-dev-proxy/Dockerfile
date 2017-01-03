FROM docker.ttio.cloud:5000/library/nginx

COPY ./nginx/conf.d/* /etc/nginx/conf.d/
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

COPY ./certs /data/certs

RUN mkdir -p /var/www
VOLUME /var/www
