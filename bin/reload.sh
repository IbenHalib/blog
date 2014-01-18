#!/bin/sh

cd `dirname "$0"`
cd ..

set -x
curl -s https://getcomposer.org/installer | php
php composer.phar install
php app/console doctrine:database:drop --force

find app/cache/ -type d -maxdepth 1 -mindepth 1 | while read L; do
    rm -rf "$L"
done

rm -rf web/bundles
rm -rf web/css
rm -rf web/fonts
rm -rf web/images
rm -rf web/js

php app/console doctrine:database:create
php app/console doctrine:schema:update --force

php app/console braincrafted:bootstrap:install
php app/console assets:install --symlink
php app/console assetic:dump

php app/console cache:clear
php app/console doctrine:fixtures:load --no-interaction
