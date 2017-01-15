#!/bin/bash

BASE_DIR=$(cd $(dirname $0)/../ && pwd)

set -e

docker build -t ttio-dev-proxy "${BASE_DIR}/containers/ttio-dev-proxy"
docker build -t ttio-dev-frontend "${BASE_DIR}/containers/ttio-dev-frontend"
