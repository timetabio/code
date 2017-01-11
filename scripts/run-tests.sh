#!/bin/bash

assert () {
  echo "Asserting" "$@"

  if test "$@"
  then
    tput setaf 2
    echo " --> Assertion succeeded"
  else
    tput setaf 1
    echo " --> Assertion failed"
  fi

  tput sgr0
  echo ""
}

assert_status () {
  response=$(curl -I --silent "$1")
  status_line=$(printf "$response" | head -n 1 | tr -d '\r')

  assert "$status_line" = "$2"
}

test_case () {
  tput setaf 3
  echo "$(tput bold)Test:$(tput sgr0)$(tput setaf 3) $@"
  tput sgr0
  echo ""
}


test_case "The application is available on ”timetab.io” and ”www.timetab.io” through the common browser ports. (80 & 443, http will redirect to https)"

assert_status "https://www.timetab.io" "HTTP/1.1 200 OK"
assert_status "http://www.timetab.io" "HTTP/1.1 301 Moved Permanently"
assert_status "http://timetab.io" "HTTP/1.1 301 Moved Permanently"
assert_status "https://timetab.io" "HTTP/1.1 301 Moved Permanently"
