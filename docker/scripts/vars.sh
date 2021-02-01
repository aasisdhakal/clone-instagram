#!/bin/bash

#
# Contains variables used by other scripts.
#

WEB_CONTAINER_NAME='build.pagevamp.pv'

WEB_CONTAINER_ID=$(docker-compose ps -q ${WEB_CONTAINER_NAME})

WEB_CONTAINER_PROJECT_DIR="/var/www"

DB_CONTAINER_NAME=mysql

DB_CONTAINER_ID=$(docker ps -aqf "name=${DB_CONTAINER_NAME}")

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
