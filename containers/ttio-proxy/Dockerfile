FROM docker.ttio.cloud:5000/library/nginx

ARG VERSION

COPY containers/ttio-proxy/config/nginx/conf.d/* /etc/nginx/conf.d/
COPY containers/ttio-proxy/config/nginx/* /etc/nginx/

COPY Frontend/public/images /var/www/html/images
COPY Frontend/public/favicon.ico /var/www/html/favicon.ico
COPY Frontend/public/robots.txt /var/www/html/robots.txt

COPY Styles/css/application.css /var/www/html/css/application-${VERSION}.css
COPY Styles/icons /var/www/html/icons
COPY Styles/fonts /var/www/html/fonts
COPY Application/build/application.js /var/www/html/js/application-${VERSION}.js
COPY Application/build/polyfills.js /var/www/html/js/polyfills-${VERSION}.js
COPY Application/build/browser.js /var/www/html/js/browser-${VERSION}.js

VOLUME /data/ssl
VOLUME /data/certs
VOLUME /var/www/letsencrypt
