#!/bin/bash

ROOT=$(cd $(dirname $0)/../ && pwd)

if [ -z "${1}" ]; then
  echo "Usage ${0} COUNT"
  exit
fi

docker rm -f $(docker ps -aq --filter="name=ttio-dev-worker-")

for i in `seq 0 ${1}`; do
  docker run -d \
  --name ttio-dev-worker-${i} \
  --net ttio-dev-net \
  -v ${ROOT}:/data/code \
  -v ${ROOT}/persistent/nsalog/worker.txt:/data/nsalog.txt \
  docker.ttio.cloud:5000/web/worker &
done

wait
