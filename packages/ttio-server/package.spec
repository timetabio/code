%define version %(echo $VERSION)

Name: ttio-server
Version: %{version}
Release: ttio.1
Summary: timetab.io server
License: All rights reserved
BuildArch: noarch
Requires: docker-engine

%description
timetab.io server

%build
rm -rf ${RPM_BUILD_DIR}/*

cp -R %{_packagedir}/config/letsencrypt ${RPM_BUILD_DIR}/letsencrypt
cp -R %{_packagedir}/cron.d ${RPM_BUILD_DIR}/cron.d
cp %{_packagedir}/config/renew-certs.sh ${RPM_BUILD_DIR}/renew-certs.sh

%install
install -m 755 -d ${RPM_BUILD_ROOT}/etc/letsencrypt
install -m 755 -d ${RPM_BUILD_ROOT}/etc/cron.d
install -m 755 -d ${RPM_BUILD_ROOT}/usr/local/bin

cp ${RPM_BUILD_DIR}/letsencrypt/* ${RPM_BUILD_ROOT}/etc/letsencrypt/
cp ${RPM_BUILD_DIR}/cron.d/* ${RPM_BUILD_ROOT}/etc/cron.d/
cp ${RPM_BUILD_DIR}/renew-certs.sh ${RPM_BUILD_ROOT}/usr/local/bin/renew-certs

%clean
rm -rf ${RPM_BUILD_ROOT}
rm -rf ${RPM_BUILD_DIR}

%files
%defattr(-,root,root)
%dir /etc/letsencrypt
%dir /etc/cron.d
%dir /usr/local/bin
/etc/letsencrypt/*
/etc/cron.d/*
/usr/local/bin/*
