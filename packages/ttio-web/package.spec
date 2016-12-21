%define version %(echo $VERSION)

Name: ttio-web
Version: %{version}
Release: ttio.1
Summary: timetab.io web
License: All rights reserved
BuildArch: noarch
Requires: docker-engine, openssl

%description
timetab.io web

%build
rm -rf ${RPM_BUILD_DIR}/*

cp -R %{_packagedir}/units ${RPM_BUILD_DIR}/units
cp -R ${RPM_SOURCE_DIR}/API/scripts ${RPM_BUILD_DIR}/scripts
cp -R ${RPM_SOURCE_DIR}/data ${RPM_BUILD_DIR}/data
cp -R %{_packagedir}/cron.d ${RPM_BUILD_DIR}/cron.d

%install
install -m 755 -d ${RPM_BUILD_ROOT}/etc/systemd/system
install -m 755 -d ${RPM_BUILD_ROOT}/etc/cron.d
install -m 755 -d ${RPM_BUILD_ROOT}/data/patches

cp ${RPM_BUILD_DIR}/units/* ${RPM_BUILD_ROOT}/etc/systemd/system/
cp ${RPM_BUILD_DIR}/cron.d/* ${RPM_BUILD_ROOT}/etc/cron.d/
cp ${RPM_BUILD_DIR}/data/patches/*.sql ${RPM_BUILD_ROOT}/data/patches/

%clean
rm -rf ${RPM_BUILD_ROOT}
rm -rf ${RPM_BUILD_DIR}

%post
mkdir -p /data/redis
mkdir -p /data/nsalog
mkdir -p /data/ssl
mkdir -p /var/www/letsencrypt

if [ -z $(docker network inspect --format '{{.Name}}' ttio-net 2> /dev/null) ]; then
  echo "Creating network"
  docker network create ttio-net
fi

if [ ! -f /data/ssl/dhparams.pem ]; then
    openssl dhparam -out /data/ssl/dhparams.pem 2048
fi

docker pull docker.ttio.cloud:5000/web/proxy:%{version}
docker tag docker.ttio.cloud:5000/web/proxy:%{version} docker.ttio.cloud:5000/web/proxy:current

docker pull docker.ttio.cloud:5000/web/api:%{version}
docker tag docker.ttio.cloud:5000/web/api:%{version} docker.ttio.cloud:5000/web/api:current

docker pull docker.ttio.cloud:5000/web/frontend:%{version}
docker tag docker.ttio.cloud:5000/web/frontend:%{version} docker.ttio.cloud:5000/web/frontend:current

docker pull docker.ttio.cloud:5000/web/survey:%{version}
docker tag docker.ttio.cloud:5000/web/survey:%{version} docker.ttio.cloud:5000/web/survey:current

docker pull docker.ttio.cloud:5000/web/worker:%{version}
docker tag docker.ttio.cloud:5000/web/worker:%{version} docker.ttio.cloud:5000/web/worker:current

docker pull docker.ttio.cloud:5000/library/redis:latest
docker tag docker.ttio.cloud:5000/library/redis:latest docker.ttio.cloud:5000/library/redis:current

docker pull docker.ttio.cloud:5000/library/postgres:latest
docker tag docker.ttio.cloud:5000/library/postgres:latest docker.ttio.cloud:5000/library/postgres:current

docker pull docker.ttio.cloud:5000/library/elastic:latest
docker tag docker.ttio.cloud:5000/library/elastic:latest docker.ttio.cloud:5000/library/elastic:current

systemctl daemon-reload

systemctl enable ttio-web.target
systemctl restart ttio-web.target

docker exec -i ttio-api /data/code/API/scripts/create-system-token.php

docker run --rm \
  --net ttio-net \
  -v /data/patches:/data/patches \
  -v /data/applied-patches:/data/applied \
  docker.ttio.cloud:5000/library/postgres \
  env TERM=xterm POSTGRES_HOST=ttio-postgres ttio-patch

docker run --rm \
    --net ttio-net \
    docker.ttio.cloud:5000/web/worker:current /data/code/Worker/push.php Initial

%files
%defattr(-,root,root)
%dir /etc/systemd/system
%dir /etc/cron.d
%dir /data/patches
/etc/systemd/system/*
/etc/cron.d/*
/data/patches/*
