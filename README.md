# Slim 4 skeleton

[![CodeFactor](https://www.codefactor.io/repository/github/cvar1984/slim/badge)](https://www.codefactor.io/repository/github/cvar1984/slim)
![PHP Composer](https://github.com/Cvar1984/slim/workflows/PHP%20Composer/badge.svg?branch=master)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

Slim 4 skeleton with basic parallax homepages
## demo
[heroku](https://cvar-slim.herokuapp.com)
## install to webroot
clone to your htdocs
```sh
git clone <link>
```
move everything to `/var/www/html (webroot)`

then go to `/var/www/html` and install depencies
```sh
composer install --no-dev
yarn install
```
edit `/var/www/html/app/middleware.php`

comment this
```php
// $app->setBasepath();
```
start your webservice like apache or something like
```sh
php -S 127.0.0.1:8080 -t /var/www/html/public
```
## install to webroot/custom
clone to your htdocs
```sh
git clone <link>
```
move everything to `/var/www/html/custom (webroot)`

then go to `/var/www/html/custom` and install depencies
```sh
composer install --no-dev
yarn install
```
edit `/var/www/html/app/middleware.php`
do this
```php
$app->setBasepath('/custom');
```
start your webservice like apache or something like
```sh
php -S 127.0.0.1:8080 -t /var/www/html/custom/public
```
