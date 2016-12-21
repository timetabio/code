#!/bin/bash

ROOT=$(cd $(dirname $0)/../ && pwd)

if [ -z "${1}" ]; then
  echo "Usage ${0} COUNT"
  exit
fi

for i in `seq 1 ${1}`; do
  docker logs -f ttio-dev-worker-${i} &
done

wait
