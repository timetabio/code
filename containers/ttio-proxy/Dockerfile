FROM docker.ttio.cloud:5000/library/nginx

ARG VERSION
ENV TEMPLATE_FILE /var/www/html/index.html

COPY containers/ttio-proxy/config/nginx/conf.d/* /etc/nginx/conf.d/
COPY containers/ttio-proxy/config/nginx/* /etc/nginx/

COPY Frontend/public/images /var/www/html/images
COPY Frontend/public/favicon.ico /var/www/html/favicon.ico
COPY Frontend/public/robots.txt /var/www/html/robots.txt
COPY Frontend/public/index.html ${TEMPLATE_FILE}
COPY Frontend/scripts/add-versions.sh /bin/add-versions

COPY Styles/css/application.css /var/www/html/css/application-${VERSION}.css
COPY Styles/icons /var/www/html/icons
COPY Styles/fonts /var/www/html/fonts
COPY Application/build/application.js /var/www/html/js/application-${VERSION}.js
COPY Application/build/polyfills.js /var/www/html/js/polyfills-${VERSION}.js
COPY Application/build/browser.js /var/www/html/js/browser-${VERSION}.js

RUN apk add --no-cache bash
RUN chmod +x /bin/add-versions
RUN mv ${TEMPLATE_FILE} ${TEMPLATE_FILE}.source && \
    cat ${TEMPLATE_FILE}.source | add-versions > ${TEMPLATE_FILE} && \
    rm ${TEMPLATE_FILE}.source

VOLUME /data/ssl
VOLUME /data/certs
VOLUME /var/www/letsencrypt
