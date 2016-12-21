#!/bin/bash

log () {
  tput setaf 2
  echo "${1}"
  tput sgr0
}

fold_start () {
  if [ ! -z "${TRAVIS}" ]; then
    echo -en "travis_fold:start:${1}\\r"
  fi
}

fold_end () {
  if [ ! -z "${TRAVIS}" ]; then
    echo -en "travis_fold:end:${1}\\r"
  fi
}
