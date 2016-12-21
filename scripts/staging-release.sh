#!/bin/bash

if [ -z ${VERSION} ]; then
  echo "Refusing to run without VERSION. Stop"
  exit
fi

log () {
  tput setaf 2
  echo "--> ${1}..."
  tput sgr0
}

KEEP_STAGING=0
FETCH_CERTS=1
SKIP_CONTAINERS=0

for ARG in $@; do
  case ${ARG} in
    --keep)
      KEEP_STAGING=1
      ;;
    --no-fetch)
      FETCH_CERTS=0
      ;;
    --skip-containers)
      SKIP_CONTAINERS=1
  esac
done

./scripts/start-the-magic.sh --stop

log "Fetching letsencrypt data"
if [ ${FETCH_CERTS} -eq 1 ]; then
  rm -rf ./persistent/letsencrypt
  mkdir -p ./persistent/letsencrypt/live
  scp -r root@timetab.io:/etc/letsencrypt/live ./persistent/letsencrypt/
fi

log "Preparing staging container"
if [ ${KEEP_STAGING} -eq 0 ]; then
  docker build -t ttio-staging ./containers/ttio-staging
  docker rm -f ttio-staging
fi

docker run -d \
           -p 80:80 \
           -p 443:443 \
           -v $(pwd)/persistent/letsencrypt/live:/etc/letsencrypt/live \
           --name ttio-staging \
           --privileged \
           ttio-staging

if [ ${KEEP_STAGING} -eq 0 ]; then
  log "Authenticating with docker registry"
  docker exec -it ttio-staging sh -c 'docker login docker.ttio.cloud:5000'
fi

set -e

if [ ${SKIP_CONTAINERS} -eq 0 ]; then
  log "Building containers"
  ./scripts/build-containers.sh

  log "Pushing containers"
  ./scripts/push-containers.sh
fi

log "Building rpms"
./scripts/rake.sh VERSION=${VERSION} rpm

log "Releasing rpms"

docker exec -it ttio-staging rpm -e ttio-web || true
docker exec -it ttio-staging rpm -e ttio-server || true

TTIO_RELEASE_TARGET='docker' ./scripts/release-packages.sh
