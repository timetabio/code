#!/bin/bash


if [ -z "${1}" ]; then
  echo "Usage: ${0} VERSION"
  exit 1
fi

CHANGELOG=$(git log --pretty=format:"- %s%n%b" --since="$(git show -s --format=%ad `git rev-list --tags --max-count=1`)" | grep -v "Merge branch" | grep .)
MESSAGE="${1}\n\n${CHANGELOG}"

printf "${MESSAGE}\n"

printf "${MESSAGE}" | hub release create ${1} -f -
