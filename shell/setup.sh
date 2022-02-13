#!/bin/bash

echo "##################################"
echo "# Begin setup...                 #"
echo "##################################"

touch "$PWD/database/database.sqlite"

cp .env.example .env
sed -i~ "s/DB_CONNECTION=.*/DB_CONNECTION=sqlite/g" .env
sed -i~ "s|DB_DATABASE=.*|DB_DATABASE=$PWD/database/database.sqlite|g" .env
rm .env~

composer install

php artisan key:generate
php artisan migrate
php artisan passport:install --force

echo "Finish setup!"
