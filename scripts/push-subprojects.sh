#!/bin/bash

if [ "${TRAVIS_BRANCH}" != "master" ]
then
  exit
fi

wget https://raw.githubusercontent.com/bash/git-subhistory/signing/git-subhistory.sh
chmod +x git-subhistory.sh

git remote add styles git@github.com:timetabio/styles.git
git remote add application git@github.com:timetabio/application.git

git fetch styles
git fetch application

./git-subhistory.sh split Styles/ styles/master
git push styles SPLIT_HEAD:master

./git-subhistory.sh split Application/ application/master
git push application SPLIT_HEAD:master

rm git-subhistory.sh
