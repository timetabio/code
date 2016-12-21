#!/bin/bash

set -e

log () {
  tput setaf 2
  echo "--> ${1}..."
  tput sgr0
}

log "Building containers"
VERSION=${TRAVIS_TAG} ./scripts/build-containers.sh

log "Pushing containers"
VERSION=${TRAVIS_TAG} ./scripts/push-containers.sh

log "Building rpm packages with version ${TRAVIS_TAG}"
./scripts/rake.sh VERSION=${TRAVIS_TAG} TTIO_BUILD_ENV=production rpm

log "Installing rpm packages"
VERSION=${TRAVIS_TAG} ./scripts/release-packages.sh
