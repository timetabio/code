FROM docker.ttio.cloud:5000/library/php

# Framework
COPY Framework/src /data/code/Framework/src
COPY Framework/lib /data/code/Framework/lib
COPY Framework/bootstrap.php /data/code/Framework/bootstrap.php

# Library
COPY Library/src /data/code/Library/src
COPY Library/bootstrap.php /data/code/Library/bootstrap.php

# Ink
COPY Ink/src /data/code/Ink/src

# Worker
COPY config/live/worker.ini /data/code/Worker/config/system.ini
COPY Worker/data /data/code/Worker/data
COPY Worker/src /data/code/Worker/src
COPY Worker/bootstrap.php /data/code/Worker/bootstrap.php
COPY Worker/worker.php /data/code/Worker/worker.php
COPY Worker/push.php /data/code/Worker/push.php

# Locale
COPY Locale /data/code/Locale
RUN rm /data/code/Locale/Rakefile

VOLUME /data/code

CMD ["/data/code/Worker/worker.php"]
