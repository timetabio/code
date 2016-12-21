FROM docker.ttio.cloud:5000/library/fpm

ARG VERSION
ENV TEMPLATE_FILE /data/code/Frontend/data/templates/template.html

# Framework
COPY Framework/src /data/code/Framework/src
COPY Framework/lib /data/code/Framework/lib
COPY Framework/bootstrap.php /data/code/Framework/bootstrap.php

# Library
COPY Library/src /data/code/Library/src
COPY Library/bootstrap.php /data/code/Library/bootstrap.php

# Ink
COPY Ink/src /data/code/Ink/src

# Frontend
COPY config/live/frontend.ini /data/code/Frontend/config/system.ini
COPY Frontend/data /data/code/Frontend/data
COPY Frontend/src /data/code/Frontend/src
COPY Frontend/scripts /data/code/Frontend/scripts
COPY Frontend/bootstrap.php /data/code/Frontend/bootstrap.php
COPY Frontend/index.php /data/code/Frontend/index.php

# Locale
COPY Locale /data/code/Locale
RUN rm /data/code/Locale/Rakefile

RUN mv ${TEMPLATE_FILE} ${TEMPLATE_FILE}.source && \
    cat ${TEMPLATE_FILE}.source | /data/code/Frontend/scripts/add-versions.sh > ${TEMPLATE_FILE} && \
    rm ${TEMPLATE_FILE}.source

VOLUME /data/code
