#!/bin/sh

TOKEN=$(docker exec ttio-dev-redis redis-cli --raw GET system_token)
API_BASE='https://devapi.timetab.io/v1'

printf 'Email [peanutbutter@timetab.io]: '
read EMAIL

printf 'Username [peanut_butter]: '
read USERNAME

printf 'Password [foo_bar_baz]: '
read -s PASSWORD

echo ""

if [ -z "${EMAIL}" ]; then
  EMAIL='peanutbutter@timetab.io'
fi

if [ -z "${USERNAME}" ]; then
  USERNAME='peanut_butter'
fi

if [ -z "${PASSWORD}" ]; then
  PASSWORD='foo_bar_baz'
fi

curl -X POST ${API_BASE}/users -H "Authorization: Bearer ${TOKEN}" -d username="${USERNAME}" -d password="${PASSWORD}" -d email="${EMAIL}"

VERIFY_TOKEN=($(docker exec -i ttio-dev-postgres psql -U postgres -t -q -c "SELECT token FROM verification_tokens WHERE email='${EMAIL}' LIMIT 1"))

curl -X POST ${API_BASE}/verify -H "Authorization: Bearer ${TOKEN}" -d token=${VERIFY_TOKEN}
