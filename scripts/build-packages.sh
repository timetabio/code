#!/bin/bash

set -e

source $(cd $(dirname $0) && pwd)/common.sh

BUILD_DIR="/data/code"
PACKAGE_DIR="${BUILD_DIR}/packages"

for PACKAGE in ${PACKAGE_DIR}/*; do
  RPM_DIR="${PACKAGE}/rpm"
  SPEC_FILE="${PACKAGE}/package.spec"

  fold_start "${PACKAGE}"
  log "Building RPM package ${PACKAGE}"

  rm -rf ${RPM_DIR}
  mkdir -p ${RPM_DIR}

  if [ "${TTIO_BUILD_ENV}" = 'production' ]; then
    tput setaf 3
    echo "Fixing owner root:root on '${SPEC_FILE}'"
    tput sgr0
    chown root:root ${SPEC_FILE}
  fi

  rpmbuild -ba ${SPEC_FILE} \
         --define "_sourcedir ${BUILD_DIR}" \
         --define "_rpmdir ${RPM_DIR}" \
         --define "_packagedir ${PACKAGE}"

  mv ${RPM_DIR}/noarch/*.rpm ${RPM_DIR}/
  rm -rf ${RPM_DIR}/noarch

  fold_end "${PACKAGE}"
done
