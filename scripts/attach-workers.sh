#!/bin/bash

PIDS=()

cleanup () {
  for PID in ${PIDS[@]}; do
    kill ${PID} 2&> /dev/null
  done
}

trap cleanup SIGINT SIGTERM EXIT

WORKERS=$(docker ps -q --filter="name=ttio-dev-worker-")

for WORKER in ${WORKERS[@]}; do
  docker logs -f ${WORKER} &
  PIDS+=("${!}")
done

wait
