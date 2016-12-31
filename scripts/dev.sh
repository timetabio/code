#!/bin/bash

source $(cd $(dirname $0) && pwd)/common.sh

ROOT=$(cd $(dirname $0)/../ && pwd)
RC_FILE=${ROOT}/.devrc

if [ -z ${WORKER_INSTANCES} ]; then
  WORKER_INSTANCES=1
fi

if [ -f ${RC_FILE} ]; then
  source ${RC_FILE}
fi

STOP=0
BUILD=0
WORKER=0
SCHEMA=0
HELP=0
START=0
PATCH=0
CLEANUP=0

CONTAINERS=(
  ttio-dev-proxy
  ttio-dev-api
  ttio-dev-frontend
  ttio-dev-survey
  ttio-dev-redis
  ttio-dev-postgres
  ttio-elastic
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
    --schema)
      SCHEMA=1
      ;;
    --patch)
      PATCH=1
      ;;
    --bootstrap)
      BUILD=1
      SCHEMA=1
      STOP=1
      START=1
      ;;
    --help)
      HELP=1
      ;;
    --start)
      START=1
      PATCH=1
      ;;
    --restart)
      START=1
      STOP=1
      ;;
    --cleanup)
      CLEANUP=1
      ;;
    *)
      echo "Unknown option ${ARG}"
      exit 1
  esac
done

print_help () {
  echo "Usage: ${0} OPTION [...OPTIONS]"
  echo ""
  echo "Options:"
  echo "--help             Show this help"
  echo "--stop             Stops all containers"
  echo "--start            Starts all containers"
  echo "--restarts         Restarts all containers"
  echo "--worker           Restarts worker"
  echo "--build            Builds dev containers"
  echo "--schema           Bootstraps schemas (elastic, postgres)"
  echo "--patch            Apply SQL patches"
  echo "--bootstrap        Shortcut for (--build, --schema and --restart)"
  echo "--cleanup          Deletes sessions, tokens"
  exit
}

generate_sys_token () {
  log "Generating system token"
  docker exec -it ttio-dev-api /data/code/API/scripts/create-system-token.php
}

prepare_environment () {
  mkdir -p ${ROOT}/persistent/nsalog

  touch ${ROOT}/persistent/nsalog/api.txt
  touch ${ROOT}/persistent/nsalog/frontend.txt
  touch ${ROOT}/persistent/nsalog/worker.txt
  touch ${ROOT}/persistent/nsalog/survey.txt

  if [ -z $(docker network inspect --format '{{.Name}}' ttio-dev-net 2> /dev/null) ]; then
    log "Creating network"
    docker network create ttio-dev-net
  fi
}

build_containers () {
  if [ -d ${ROOT}/../containers ]; then
    ( cd ${ROOT}/../containers ; ./build.sh )
  else
    echo "Warning: containers repository not found in expected location"
  fi

  VERSION=$(git describe --abbrev=0 --tags) ${ROOT}/scripts/build-containers.sh
  ${ROOT}/scripts/build-dev-containers.sh
}

stop_workers () {
  log "Stopping running worker(s)"
  WORKERS=$(docker ps -a -q --filter="name=ttio-dev-worker-")

  for WORKERS in ${WORKERS[@]}; do
    docker rm -f ${WORKERS} &
  done

  wait
}

stop_containers () {
  log "Stopping running containers"

  for CONTAINER in ${CONTAINERS[@]}; do
    docker rm -f ${CONTAINER}
  done

  wait
}

start_containers () {
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

  generate_sys_token

  log "Waiting for postgres to start"
  await_output ttio-dev-postgres "database system is ready to accept connections"

  log "Waiting for elastic to start"
  await_output ttio-elastic ":9200"

  start_workers

  log "Running initial task"
  ${ROOT}/scripts/push-task.sh Initial
}

start_workers () {
  log "Starting ${WORKER_INSTANCES} worker instance(s)"

  for i in `seq 1 ${WORKER_INSTANCES}`; do
    docker run -d \
    --name ttio-dev-worker-${i} \
    --net ttio-dev-net \
    -v ${ROOT}:/data/code \
    -v ${ROOT}/persistent/nsalog/worker.txt:/data/nsalog.txt \
    docker.ttio.cloud:5000/web/worker &
  done

  wait
}

bootstrap_elastic () {
  log "Bootstrapping elastic"
  ${ROOT}/scripts/elastic.sh reset
}

bootstrap_postgres () {
  log "Bootstrapping postgres"
  docker run --rm \
    --net ttio-dev-net \
    -v ${ROOT}/data/schema.sql:/schema.sql \
    docker.ttio.cloud:5000/library/postgres \
    env psql -U postgres -h ttio-dev-postgres -a -f /schema.sql
}

apply_patches () {
  docker run --rm \
    --net ttio-dev-net \
    -v ${ROOT}/data/patches:/data/patches \
    -v ${ROOT}/persistent/applied-patches:/data/applied \
    docker.ttio.cloud:5000/library/postgres \
    env TERM=xterm POSTGRES_HOST=ttio-dev-postgres ttio-patch
}

cleanup_redis () {
  log "Deleting sessions"
  docker exec ttio-dev-redis redis-cli --raw KEYS session* | xargs docker exec ttio-dev-redis redis-cli DEL
  log "Deleting access tokens"
  docker exec ttio-dev-redis redis-cli --raw KEYS access_token* | xargs docker exec ttio-dev-redis redis-cli DEL
  log "Deleting system token"
  docker exec ttio-dev-redis redis-cli DEL system_token
}


if [ -z ${1} ] || [ ${HELP} -eq 1 ]; then
  print_help
fi

prepare_environment

if [ ${BUILD} -eq 1 ]; then
  build_containers
fi

if [ ${CLEANUP} -eq 1 ]; then
  cleanup_redis
  generate_sys_token
fi

if [ ${STOP} -eq 1 ]; then
  stop_workers
  stop_containers
fi

if [ ${START} -eq 1 ]; then
  start_containers
fi

if [ ${WORKER} -eq 1 ]; then
  stop_workers
  start_workers
fi

if [ ${PATCH} -eq 1 ]; then
  apply_patches
fi

if [ ${SCHEMA} -eq 1 ]; then
  bootstrap_postgres
  bootstrap_elastic
fi
