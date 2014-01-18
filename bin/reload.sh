#!/bin/sh

cd `dirname "$0"`
cd ..

set -x
curl -s https://getcomposer.org/installer | php
php composer.phar install

php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:update --force

php app/console braincrafted:bootstrap:install
php app/console assets:install --symlink
php app/console assetic:dump

php app/console cache:clear
php app/console doctrine:fixtures:load --no-interaction
