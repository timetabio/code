#!/bin/bash

if [ -z "${1}" ]; then
  echo "Usage: ${0} VERSION"
  exit 1
fi

CHANGELOG=$(git log --pretty=format:"- %s%n" master...$(git describe --abbrev=0 --tags) | grep -v "Merge branch" | grep -v "Merge commit" | grep .)
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
