#!/bin/bash

WORKER_INSTANCE=$(docker ps -q --filter="name=ttio-dev-worker-" | head -n 1)

docker exec ${WORKER_INSTANCE} /data/code/Worker/push.php ${@:1}
