#!/bin/bash

cp deploy/docker-compose-example.yml docker-compose.yml
cp deploy/credentials .credentials

echo "Follow the instruction to setup your take-eir website easily"

read -p "Enter the root password for MySQL : "  root_password
read -p "Enter the local user password for MySQL : "  user_password

read -p "Enter the email address you wish to use [empty for none] : " email
read -p "Enter the password for the email [empty for none] : " email_passwd

sed -i "s/your_root_password/$root_password/" docker-compose.yml
sed -i "s/your_password/$user_password/" docker-compose.yml
sed -i "s/super_password/$user_password/" .credentials

sed -i "s/super_email/$email/" .credentials
sed -i "s/super_key/$email_passwd/" .credentials

read -p "Credentials are all setup, the script will now create the docker containers (enter to continue)"

docker-compose up
