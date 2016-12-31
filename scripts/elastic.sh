#!/bin/bash

ROOT=$(cd $(dirname $0)/../ && pwd)

reset () {
  docker run --rm \
      --net ttio-dev-net \
      docker.ttio.cloud:5000/library/elastic \
      sh -c 'curl -s -X DELETE http://ttio-elastic:9200/ttio'
  echo ""
  sleep 2
  mappings
  index
}

mappings () {
  docker run --rm \
    --net ttio-dev-net \
    -v ${ROOT}/data/elastic-mappings.json:/mappings.json \
    docker.ttio.cloud:5000/library/elastic \
    sh -c 'curl -s -X PUT http://ttio-elastic:9200/ttio -d @/mappings.json'
  echo ""
}

index () {
  ${ROOT}/scripts/push-task.sh IndexUsers
  ${ROOT}/scripts/push-task.sh IndexFeeds
}

print_help () {
  echo "Usage: ${0} COMMAND"
  echo ""
  echo "Available commands:"
  echo "index           Queues all indexing tasks"
  echo "mappings        Create index with mappings"
  echo "reset           Deletes and recreates index, queues tasks"
  exit 1
}

if [ -z "${1}" ]; then
  print_help
fi

case ${1} in
  reset)
    reset
    ;;
  mappings)
    mappings
    ;;
  index)
    index
    ;;
  *)
    echo "Unknown command ${1}"
esac
