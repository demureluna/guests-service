#!/bin/bash

echo -e "Killing apache2 process (if exists)\n"
systemctl kill apache2

echo -e "\nBuilding main application container via Dockerfile:\n"
docker build -t guestsservice .

echo -e "\nStarting all containers:\n"
docker compose up -d

echo -e "\nMigrating database:\n"
docker exec -it guestsservice vendor/bin/phpmig migrate

echo -e "\nSetting rights to folders in container:\n"
docker exec -it guestsservice chmod -R 777 /var/

echo -e "\nSuccess!\n"

read -p "Application is running! To turn application down, press 'Enter'..." 

docker compose down