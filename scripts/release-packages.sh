#!/bin/bash

set -e

HOST='root@timetab.io'

if [ -z ${TTIO_RELEASE_TARGET} ]; then
  TTIO_RELEASE_TARGET='ssh'
fi

log() {
  tput setaf 2
  echo "${1}"
  tput sgr0
}

exec_command () {
  if [ ${TTIO_RELEASE_TARGET} = 'docker' ]; then
    docker exec -it ttio-staging bash -c "${1}"
  else
    ssh -t ${HOST} "${1}"
  fi
}

upload_file () {
  if [ ${TTIO_RELEASE_TARGET} = 'docker' ]; then
    docker cp ${1} ttio-staging:${2}
  else
    scp ${1} ${HOST}:${2}
  fi
}

UPLOADDIR="/data/rpms/${VERSION}"

exec_command "mkdir -p ${UPLOADDIR}"

log "Uploading packages to '${UPLOADDIR}'..."

upload_file ./packages/ttio-server/rpm/*.rpm ${UPLOADDIR}/
upload_file ./packages/ttio-web/rpm/*.rpm ${UPLOADDIR}/
upload_file ./packages/ttio-docker-registry/rpm/*.rpm ${UPLOADDIR}/

log "Installing packages..."

exec_command "
  PACKAGES=(
    ttio-web
    ttio-server
    ttio-docker-registry
  )

  for PACKAGE in \${PACKAGES[@]}; do
    OLD_VERSION=\$(rpm -qa --queryformat '%{version}' \${PACKAGE})

    rpm -Uvh ${UPLOADDIR}/\${PACKAGE}-*.rpm

    if [ $? -ne 0 ]; then
      rpm -Uvh --oldpackage /data/rpms/\${OLD_VERSION}/\${PACKAGE}-*.rpm
    fi
  done
"
