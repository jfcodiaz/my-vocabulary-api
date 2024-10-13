#!/bin/bash

echo "Creating database: ${MYSQL_DATABASE}_test"

mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS ${MYSQL_DATABASE}_TEST;"

