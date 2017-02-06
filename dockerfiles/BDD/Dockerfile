FROM ubuntu:16.04
MAINTAINER Ponchau Simon <simon@ponchau.eu>

ENV MYSQL_ROOT_PASSWORD 'Passw0rd'

RUN apt-get update


RUN echo "mysql-server mysql-server/root_password password Passw0rd" | debconf-set-selections
RUN echo "mysql-server mysql-server/root_password_again password Passw0rd" | debconf-set-selections
RUN apt-get -y install mysql-server



