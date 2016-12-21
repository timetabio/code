#!/bin/bash

ROOT=$(cd $(dirname $0)/../ && pwd)

STOP=0
BUILD=0
WORKER=0
INITIAL=0

CONTAINERS=(
  ttio-dev-proxy
  ttio-dev-api
  ttio-dev-frontend
  ttio-dev-survey
  ttio-dev-redis
  ttio-dev-postgres
  ttio-elastic
  ttio-dev-worker
)

for ARG in $@; do
  case ${ARG} in
    --stop)
      STOP=1
      ;;
    --build)
      BUILD=1
      ;;
    --worker)
      WORKER=1
      ;;
    --initial)
      INITIAL=1
      ;;
    *)
      echo "Unknown flag ${ARG}"
      exit 1
  esac
done

log () {
  tput setaf 2
  echo "--> ${1}..."
  tput sgr0
}

await_output () {
  FILE=$(mktemp)
  docker logs -f "${1}" > ${FILE} 2>&1 &
  PID=$!
  grep -m 1 "${2}" <(tail -f ${FILE})
  kill ${PID}
  rm ${FILE}
}

mkdir -p ${ROOT}/persistent/nsalog

touch ${ROOT}/persistent/nsalog/api.txt
touch ${ROOT}/persistent/nsalog/frontend.txt
touch ${ROOT}/persistent/nsalog/worker.txt
touch ${ROOT}/persistent/nsalog/survey.txt

if [ ${BUILD} -eq 1 ]; then
  # VERSION=$(git describe --abbrev=0 --tags) ${ROOT}/scripts/build-containers.sh
  VERSION='0.0.1' ${ROOT}/scripts/build-containers.sh
  ${ROOT}/scripts/build-dev-containers.sh
fi

if [ -z $(docker network inspect --format '{{.Name}}' ttio-dev-net 2> /dev/null) ]; then
  log "Creating network"
  docker network create ttio-dev-net
fi

log "Stopping running containers"
if [ ${WORKER} -eq 1 ]; then
 docker rm -f ttio-dev-worker &
else
  docker rm -f $(docker ps -q --filter="name=ttio-dev-worker-")

  for CONTAINER in ${CONTAINERS[@]}; do
    docker rm -f ${CONTAINER} &
  done
fi

wait

if [ ${STOP} -eq 1 ]; then
  exit
fi

log "Starting redis"
docker run -d \
  --name ttio-dev-redis \
  --net ttio-dev-net \
  -v ${ROOT}/persistent/redis:/data \
  docker.ttio.cloud:5000/library/redis &

log "Starting postgres"
docker run -d \
  --name ttio-dev-postgres \
  --net ttio-dev-net \
  -p 127.0.0.1:5432:5432 \
  -v ${ROOT}/persistent/postgres:/var/lib/postgresql/data \
  docker.ttio.cloud:5000/library/postgres &

log "Starting elastic"
docker run -d \
  --name ttio-elastic \
  --net ttio-dev-net \
  -v ${ROOT}/persistent/elastic:/usr/share/elasticsearch/data \
  -v ${ROOT}/containers/ttio-elastic/mappings.json:/data/mappings.json \
  -p 9200:9200 \
  docker.ttio.cloud:5000/library/elastic &

wait

log "Starting api"
docker run -d \
  --name ttio-dev-api \
  --net ttio-dev-net \
  -v ${ROOT}:/data/code \
  -v ${ROOT}/persistent/nsalog/api.txt:/data/nsalog.txt \
  docker.ttio.cloud:5000/web/api &

log "Starting frontend"
docker run -d \
  --name ttio-dev-frontend \
  --net ttio-dev-net \
  -v ${ROOT}:/data/code \
  -v ${ROOT}/persistent/nsalog/frontend.txt:/data/nsalog.txt \
  ttio-dev-frontend &

log "Starting survey"
docker run -d \
  --name ttio-dev-survey \
  --net ttio-dev-net \
  -v ${ROOT}:/data/code \
  -v ${ROOT}/persistent/nsalog/survey.txt:/data/nsalog.txt \
  ttio-dev-survey &

wait

log "Starting nginx"
docker run -d \
  --name ttio-dev-proxy \
  --net ttio-dev-net \
  -p 80:80/tcp \
  -p 443:443/tcp \
  -v ${ROOT}:/var/www \
  ttio-dev-proxy


PROXY_IP=$(docker inspect --format '{{with index .NetworkSettings.Networks "ttio-dev-net"}}{{.IPAddress}}{{end}}' ttio-dev-proxy)

docker exec -it ttio-dev-frontend bash -c "echo '${PROXY_IP} devapi.timetab.io' >> /etc/hosts"
docker exec -it ttio-dev-survey bash -c "echo '${PROXY_IP} devapi.timetab.io' >> /etc/hosts"

log "Generating system token"
docker exec -it ttio-dev-api /data/code/API/scripts/create-system-token.php

log "Waiting for postgres to start"
await_output ttio-dev-postgres "database system is ready to accept connections"

if [ ${INITIAL} -eq 1 ]; then
  log "Bootstrapping postgres"
  docker run --rm \
    --net ttio-dev-net \
    -v ${ROOT}/data/schema.sql:/schema.sql \
    docker.ttio.cloud:5000/library/postgres \
    env psql -U postgres -h ttio-dev-postgres -a -f /schema.sql
fi

docker run --rm \
  --net ttio-dev-net \
  -v ${ROOT}/data/patches:/data/patches \
  -v ${ROOT}/persistent/applied-patches:/data/applied \
  docker.ttio.cloud:5000/library/postgres \
  env TERM=xterm POSTGRES_HOST=ttio-dev-postgres ttio-patch

log "Waiting for elastic to start"
await_output ttio-elastic ":9200"

log "Starting worker"
docker run -d \
  --name ttio-dev-worker \
  --net ttio-dev-net \
  -v ${ROOT}:/data/code \
  -v ${ROOT}/persistent/nsalog/worker.txt:/data/nsalog.txt \
  docker.ttio.cloud:5000/web/worker

log "Bootstrapping elastic"
docker run --rm \
  --net ttio-dev-net \
  -v ${ROOT}/data/elastic-mappings.json:/mappings.json \
  docker.ttio.cloud:5000/library/elastic \
  sh -c 'curl -X PUT http://ttio-elastic:9200/ttio -d @/mappings.json'
echo ""

if [ ${WORKER} -eq 0 ]; then
  log "Running initial task"
  docker exec ttio-dev-worker /data/code/Worker/push.php Initial
fi
