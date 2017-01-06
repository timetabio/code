#!/bin/bash

if [ -z ${VERSION} ]; then
  echo "Refusing to build without VERSION"
  exit
fi

FILES=(
  /js/polyfills.js
  /js/application.js
  /js/browser.js
  /css/application.css
)

TEMPLATE=$(cat)

for FILE in ${FILES[@]}; do
  EXTENSION="${FILE##*.}"
  FILENAME="${FILE%.*}"
  TEMPLATE=$(echo "${TEMPLATE}" | sed "s#${FILE}#${FILENAME}-${VERSION}.${EXTENSION}#g")
done

echo "${TEMPLATE}"
