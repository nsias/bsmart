#!/usr/bin/env bash

if [ $(whoami) == 'root' ]; then
    SUDO=''
else
    SUDO='sudo'
fi

# Linux kernel recommended packages & https wget|curl dependencies -------------
DEPENDENCIES=curl \
    linux-image-extra-$(uname) \
    linux-image-extra-virtual \
    apt-transport-https \
    ca-certificates

$SUDO apt-get update
$SUDO apt-get install -y $DEPENDENCIES
# /-----------------------------------------------------------------------------

# Installs last version of Docker  ---------------------------------------------
curl -fsSl https://yum.dockerproject.org/gpg | $SUDO apt-key add -

$SUDO apt-get install -y software-properties-common
$SUDO add-apt-repository \
    "deb https://apt.dockerproject.org/repo/ \
    ubuntu-$(lsb_release -cs) \
    main"

$SUDO apt-get update
[ ! $(which docker 2>/dev/null) ] && $SUDO apt-get -y install docker-engine
# /-----------------------------------------------------------------------------

# Installs Docker-compose  -----------------------------------------------------
$SUDO curl -L "https://github.com/docker/compose/releases/download/1.10.0/docker-compose-$(uname -s)-$(uname -m)" \
    -o /usr/local/bin/docker-compose
$SUDO chmod a+x /usr/local/bin/docker-compose
# /-----------------------------------------------------------------------------

echo 'Docker installation finished successfully.'
exit 0
