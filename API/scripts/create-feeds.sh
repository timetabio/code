#!/bin/sh

WORDS=$(curl "https://raw.githubusercontent.com/hzlzh/Domain-Name-List/master/Animal-words.txt")
API_BASE='https://devapi.timetab.io/v1'

TOKEN_JSON=$(curl -X POST ${API_BASE}/auth -d user='peanut_butter' -d password='foo_bar_baz' -d scopes='*')
TOKEN=$(echo ${TOKEN_JSON} | python -c "import json, sys; obj = json.load(sys.stdin); print obj['access_token'];")

for WORD in ${WORDS}; do
  curl -X POST ${API_BASE}/feeds -H "Authorization: Bearer ${TOKEN}" -d name=${WORD} -d is_private=false
done
