#!/bin/bash

echo -e "Building main application container via Dockerfile:\n"
docker build -t guestsservice .

echo -e "\nStarting all containers:\n"
docker compose up -d

echo -e "\nMigrating database:\n"
docker exec -it guestsservice vendor/bin/phpmig migrate

echo -e "\nSuccess!\n"

read -p "Application is running! To turn application down, press 'Enter'..." 

docker compose down