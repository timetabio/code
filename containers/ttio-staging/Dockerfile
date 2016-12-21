FROM library/centos:7

COPY config/docker.repo /etc/yum.repos.d/docker.repo

RUN yum -y install openssl systemd docker-engine && \
    yum clean all

RUN systemctl enable docker

EXPOSE 80
EXPOSE 443

VOLUME /etc/letsencrypt/live

CMD /usr/sbin/init
