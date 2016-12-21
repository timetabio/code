#!/bin/bash

BASE_DIR=$(cd $(dirname $0)/../ && pwd)

log () {
  tput setaf 2
  echo "--> ${1}..."
  tput sgr0
}

if [ -z ${VERSION} ]; then
  echo "Refusing to build without VERSION. Stop"
  exit
fi

set -e

log "Building worker"
docker build -t docker.ttio.cloud:5000/web/worker:latest -f "${BASE_DIR}/containers/ttio-worker/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/worker:latest docker.ttio.cloud:5000/web/worker:${VERSION}

log "Building api"
docker build -t docker.ttio.cloud:5000/web/api:latest -f "${BASE_DIR}/containers/ttio-api/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/api:latest docker.ttio.cloud:5000/web/api:${VERSION}

log "Building frontend"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/frontend:latest -f "${BASE_DIR}/containers/ttio-frontend/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/frontend:latest docker.ttio.cloud:5000/web/frontend:${VERSION}

log "Building survey"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/survey:latest -f "${BASE_DIR}/containers/ttio-survey/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/survey:latest docker.ttio.cloud:5000/web/survey:${VERSION}

log "Building proxy"
docker build --build-arg VERSION=${VERSION} -t docker.ttio.cloud:5000/web/proxy:latest -f "${BASE_DIR}/containers/ttio-proxy/Dockerfile" ${BASE_DIR}
docker tag docker.ttio.cloud:5000/web/proxy:latest docker.ttio.cloud:5000/web/proxy:${VERSION}
