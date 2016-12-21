FROM docker.ttio.cloud:5000/library/fpm

RUN apt-get update && \
    apt-get -y install locales && \
    echo "de_CH UTF-8" >> /etc/locale.gen && \
    echo "en_GB UTF-8" >> /etc/locale.gen && \
    locale-gen && \
    apt-get clean

ARG VERSION
ENV TEMPLATE_FILE /data/code/Survey/data/templates/template.html

# Framework
COPY Framework/src /data/code/Framework/src
COPY Framework/lib /data/code/Framework/lib
COPY Framework/bootstrap.php /data/code/Framework/bootstrap.php

# Library
COPY Library/src /data/code/Library/src
COPY Library/bootstrap.php /data/code/Library/bootstrap.php

# Ink
COPY Ink/src /data/code/Ink/src

# Survey
COPY config/live/survey.ini /data/code/Survey/config/system.ini
COPY Survey/data /data/code/Survey/data
COPY Survey/src /data/code/Survey/src
COPY Survey/bootstrap.php /data/code/Survey/bootstrap.php
COPY Survey/index.php /data/code/Survey/index.php

# Frontend
COPY Frontend/scripts/add-versions.sh /data/code/Frontend/scripts/add-versions.sh
COPY Frontend/src /data/code/Frontend/src
COPY Frontend/bootstrap.php /data/code/Frontend/bootstrap.php

# Locale
COPY Locale /data/code/Locale
RUN rm /data/code/Locale/Rakefile

RUN mv ${TEMPLATE_FILE} ${TEMPLATE_FILE}.source && \
    cat ${TEMPLATE_FILE}.source | /data/code/Frontend/scripts/add-versions.sh > ${TEMPLATE_FILE} && \
    rm ${TEMPLATE_FILE}.source

VOLUME /data/code
