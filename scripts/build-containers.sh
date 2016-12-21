#!/bin/bash

BASE_DIR=$(cd $(dirname $0)/../ && pwd)

source ${BASE_DIR}/scripts/common.sh

if [ -z ${VERSION} ]; then
  echo "Refusing to build without VERSION. Stop"
  exit
fi

set -e

fold_start "Dependencies"
log "Downloading Dependencies"
docker pull docker.ttio.cloud:5000/library/php
docker pull docker.ttio.cloud:5000/library/fpm
fold_end "Dependencies"

fold_start "Worker"
log "Building worker"
docker build -t docker.ttio.cloud:5000/web/worker:latest -f "${BASE_DIR}/containers/ttio-worker/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/worker:latest docker.ttio.cloud:5000/web/worker:${VERSION}
fold_end "Worker"

fold_start "API"
log "Building api"
docker build -t docker.ttio.cloud:5000/web/api:latest -f "${BASE_DIR}/containers/ttio-api/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/api:latest docker.ttio.cloud:5000/web/api:${VERSION}
fold_end "API"

fold_start "Frontend"
log "Building frontend"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/frontend:latest -f "${BASE_DIR}/containers/ttio-frontend/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/frontend:latest docker.ttio.cloud:5000/web/frontend:${VERSION}
fold_end "Frontend"

fold_start "Survey"
log "Building survey"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/survey:latest -f "${BASE_DIR}/containers/ttio-survey/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/survey:latest docker.ttio.cloud:5000/web/survey:${VERSION}
fold_end "Survey"

fold_start "Proxy"
log "Building proxy"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/proxy:latest -f "${BASE_DIR}/containers/ttio-proxy/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/proxy:latest docker.ttio.cloud:5000/web/proxy:${VERSION}
fold_end "Proxy"
