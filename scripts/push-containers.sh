#!/bin/bash

CONTAINERS=(
  web/worker
  web/api
  web/frontend
  web/proxy
  web/survey
)

if [ -z ${VERSION} ]; then
  echo "Refusing to build without VERSION. Stop"
  exit
fi

for CONTAINER in ${CONTAINERS[@]}; do
  docker push docker.ttio.cloud:5000/${CONTAINER}:${VERSION}
  docker push docker.ttio.cloud:5000/${CONTAINER}:latest
done
