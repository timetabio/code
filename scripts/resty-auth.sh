#!/bin/bash

function resty_auth() {
  printf "Username > "
  read USERNAME

  printf "Passsword > "
  read -s PASSWORD

  TOKEN_JSON=$(curl --silent -X POST https://devapi.timetab.io/v1/auth -d user=${USERNAME} -d password="${PASSWORD}")

  printf "\n"
  echo ${TOKEN_JSON}

  TOKEN=$(echo ${TOKEN_JSON} | python -c "import json, sys; obj = json.load(sys.stdin); print obj['access_token'];")

  resty https://devapi.timetab.io/v1 -H "Authorization: Bearer ${TOKEN}"
}
