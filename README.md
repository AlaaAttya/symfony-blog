blog_aqar
=========

To run the project run the following command

composer update

bower install

php bin/console doctrine:schema:update --force

php bin/console doctrine:fixtures:load


you can navigate to {home}/app_dev.php/admin to login
use the following credentials
username: admin
password: 123456
