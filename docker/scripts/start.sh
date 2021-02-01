#!/bin/bash

# Start the builder containers
echo 'Starting the Builder containers'
docker-compose up -d

# Set the hosts file
echo 'Setting the hosts file'
VIRTUAL_HOST_TMP=$(grep 'VIRTUAL_HOST=' docker-compose.yml | tail -n1 | awk '{ print $2}')
VIRTUAL_HOST=$(echo $VIRTUAL_HOST_TMP | sed 's/VIRTUAL_HOST=//g')
IP_ADDRESS=127.0.0.1

if grep -q "$IP_ADDRESS $VIRTUAL_HOST" /etc/hosts; then
    echo "Virtual Host already in hosts file"
else
    echo $IP_ADDRESS $VIRTUAL_HOST | sudo tee -a /etc/hosts
fi
