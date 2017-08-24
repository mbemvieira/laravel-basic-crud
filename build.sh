#!/bin/bash
###############################################################################
# Build Laravel project
#
# Required software:
#	- PHP       >=  7.0.15
#	- Composer  >=  1.4.1
#	- Node      >=  6.10.2
#	- NPM       >=  3.10.10
#
# Running Built-in server
#	- Reset DB_HOST variable to the current directory absolute path
#	- $php artisan serve --host=[=HOST] --port=[=PORT]
###############################################################################

echo;
echo '###############################################################################';
echo '# Composer and NPM packages installation';
echo '###############################################################################';
echo;
composer install;
npm install;

echo;
echo '###############################################################################';
echo '# Laravel project environment configuration';
echo '###############################################################################';
echo;
cp .env.testing .env;
php artisan key:generate;
php artisan storage:link;

echo;
echo '###############################################################################';
echo '# Loading Frontend components';
echo '###############################################################################';
echo;
npm run dev;

echo;
echo '###############################################################################';
echo '# DB migrations and seeding';
echo '###############################################################################';
echo;
sed -i "s|DB_HOST=path|DB_HOST=$(pwd)/database|" .env
touch database/database.sqlite;
php artisan migrate --seed;