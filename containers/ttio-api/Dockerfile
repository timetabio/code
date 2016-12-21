FROM docker.ttio.cloud:5000/library/fpm

# Framework
COPY Framework/src /data/code/Framework/src
COPY Framework/lib /data/code/Framework/lib
COPY Framework/bootstrap.php /data/code/Framework/bootstrap.php

# Library
COPY Library/src /data/code/Library/src
COPY Library/bootstrap.php /data/code/Library/bootstrap.php

# Ink
COPY Ink/src /data/code/Ink/src

# API
COPY config/live/api.ini /data/code/API/config/system.ini
COPY API/scripts /data/code/API/scripts
COPY API/src /data/code/API/src
COPY API/bootstrap.php /data/code/API/bootstrap.php
COPY API/index.php /data/code/API/index.php

VOLUME /data/code
