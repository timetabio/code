#!/bin/bash

ROOT=$(cd $(dirname $0)/../ && pwd)
RESET=0
BOOTSTRAP=0
REINDEX=0

for ARG in $@; do
  case ${ARG} in
    --reset)
      RESET=1
      BOOTSTRAP=1
      REINDEX=1
      ;;
    --bootstrap)
      BOOTSTRAP=1
      ;;
    --reindex)
      REINDEX=1
      ;;
    *)
      echo "Unknown flag ${ARG}"
      exit 1
  esac
done

if [ -z ${1} ]; then
  echo "Usage: ${0} [--reset] [--bootstrap] [--reindex]"
  exit 1
fi

if [ ${RESET} -eq 1 ]; then
  docker run --rm \
      --net ttio-dev-net \
      docker.ttio.cloud:5000/library/elastic \
      sh -c 'curl -s -X DELETE http://ttio-elastic:9200/ttio'
  echo ""
  sleep 2
fi

if [ ${BOOTSTRAP} -eq 1 ]; then
  docker run --rm \
    --net ttio-dev-net \
    -v ${ROOT}/data/elastic-mappings.json:/mappings.json \
    docker.ttio.cloud:5000/library/elastic \
    sh -c 'curl -s -X PUT http://ttio-elastic:9200/ttio -d @/mappings.json'
  echo ""
fi

if [ ${REINDEX} -eq 1 ]; then
  docker exec ttio-dev-worker /data/code/Worker/push.php IndexUsers
  docker exec ttio-dev-worker /data/code/Worker/push.php IndexFeeds
fi

