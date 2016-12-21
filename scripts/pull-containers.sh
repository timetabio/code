#!/bin/bash

CONTAINERS=(
  library/elastic
  library/fpm
  library/php
  library/postgres
  library/redis
)

for CONTAINER in ${CONTAINERS[@]}; do
  docker pull docker.ttio.cloud:5000/${CONTAINER}
done
