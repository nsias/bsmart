FROM ubuntu:16.04
MAINTAINER Ponchau Simon <simon@ponchau.eu>

RUN apt-get update
RUN apt-get install -y apache2
RUN apt-get install -y php
RUN apt-get install -y php-mysql
RUN apt-get install -y libapache2-mod-php
RUN apt-get install -y nano

COPY apache2.conf /etc/apache2/apache2.conf


RUN service apache2 start

