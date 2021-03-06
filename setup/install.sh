#!/bin/bash

# Prepare repositories
apt-get update
apt-get install -y python-software-properties
apt-get update
add-apt-repository ppa:ondrej/php5
apt-get update

# Install PHP
apt-get install -y php5-cli php5-mysql

# Install GIT
apt-get install -y git
