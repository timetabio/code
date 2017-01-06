#!/bin/bash

if [ -z "${1}" ]; then
  echo "Usage: ${0} VERSION"
  exit 1
fi

CHANGELOG=$(git log --pretty=format:"- %s%n" --since="$(git show -s --format=%ad `git rev-list --tags --max-count=1`)" | grep -v "Merge branch" | grep .)
MESSAGE="${1}\n\n${CHANGELOG}"
FILE=$(mktemp)

printf "${MESSAGE}" > ${FILE}
${EDITOR} "${FILE}"

MESSAGE=$(cat "${FILE}")
rm "${FILE}"

printf "${MESSAGE}\n\n"

read -p "Release? [ENTER] "

printf "${MESSAGE}" | hub release create ${1} -f -

git fetch
