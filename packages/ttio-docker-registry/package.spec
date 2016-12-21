Name: ttio-docker-registry
Version: 0.0.2
Release: ttio.3
Summary: docker registry
License: All rights reserved
BuildArch: noarch
Requires: docker-engine

%description
docker registry

%build
rm -rf ${RPM_BUILD_DIR}/*

cp -R %{_packagedir}/auth ${RPM_BUILD_DIR}/auth
cp -R %{_packagedir}/units ${RPM_BUILD_DIR}/units

%install
install -m 755 -d ${RPM_BUILD_ROOT}/etc/ttio/docker-registry/auth
install -m 755 -d ${RPM_BUILD_ROOT}/etc/ttio/docker-registry/data

install -m 755 -d ${RPM_BUILD_ROOT}/etc/systemd/system

cp ${RPM_BUILD_DIR}/auth/* ${RPM_BUILD_ROOT}/etc/ttio/docker-registry/auth/
cp ${RPM_BUILD_DIR}/units/* ${RPM_BUILD_ROOT}/etc/systemd/system/

%post
systemctl daemon-reload
systemctl restart ttio-docker-registry.service

%clean
rm -rf ${RPM_BUILD_ROOT}
rm -rf ${RPM_BUILD_DIR}

%files
%defattr(-,root,root)

%dir /etc/systemd/system
%dir /etc/ttio/docker-registry

/etc/ttio/docker-registry/*
/etc/systemd/system/*
