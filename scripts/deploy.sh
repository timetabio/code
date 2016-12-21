#!/bin/bash

set -e

source $(cd $(dirname $0) && pwd)/common.sh

log "Building containers"
VERSION=${TRAVIS_TAG} ./scripts/build-containers.sh

log "Pushing containers"
VERSION=${TRAVIS_TAG} ./scripts/push-containers.sh

log "Building rpm packages with version ${TRAVIS_TAG}"
./scripts/rake.sh VERSION=${TRAVIS_TAG} TRAVIS=${TRAVIS} TTIO_BUILD_ENV=production rpm

log "Installing rpm packages"
VERSION=${TRAVIS_TAG} ./scripts/release-packages.sh
