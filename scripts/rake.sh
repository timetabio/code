#!/bin/bash

docker run -v $(pwd):/data/code --rm -it docker.ttio.cloud:5000/build env TTIO_BUILD_ENV=${TTIO_BUILD_ENV} rake ${@}
