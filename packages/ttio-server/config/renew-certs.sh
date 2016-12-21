#!/bin/bash

CONFIGS=/etc/letsencrypt/*.ini

for CONFIG in ${CONFIGS[@]}; do
  /usr/bin/docker run -it --rm --name certbot \
            -v /var/www/letsencrypt:/data/web \
            -v /etc/letsencrypt:/etc/letsencrypt \
            -v /var/lib/letsencrypt:/var/lib/letsencrypt \
            quay.io/letsencrypt/letsencrypt:latest certonly --config ${CONFIG}
done

/usr/bin/systemctl restart ttio-proxy

