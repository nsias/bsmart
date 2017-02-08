FROM ubuntu:16.04
MAINTAINER Ponchau Simon <simon@ponchau.eu>

RUN apt-get update
RUN apt-get install -y apache2
RUN apt-get install -y nano
RUN a2enmod proxy proxy_http
COPY apache2.conf /etc/apache2/apache2.conf

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

