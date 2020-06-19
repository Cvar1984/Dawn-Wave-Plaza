# Dawn Wave Plaza
![njay](public/assets/local/images/logo.png)
[![CodeFactor](https://www.codefactor.io/repository/github/cvar1984/dawn-wave-plaza/badge)](https://www.codefactor.io/repository/github/cvar1984/dawn-wave-plaza)
![PHP Composer](https://github.com/Cvar1984/dawn-wave-plaza/workflows/PHP%20Composer/badge.svg?branch=master)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Build Status](https://travis-ci.com/Cvar1984/Dawn-Wave-Plaza.svg?branch=master)](https://travis-ci.com/Cvar1984/Dawn-Wave-Plaza)

Website made by slim framework
## demo
[heroku](https://dawn-wave-plaza.herokuapp.com)
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
edit `/var/www/html/app/container.php`

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
edit `/var/www/html/app/container.php`
do this
```php
$app->setBasepath('/custom');
```
start your webservice like apache or something like
```sh
php -S 127.0.0.1:8080 -t /var/www/html/custom/public
```
### Public directory
```
public/
|-- assets
|   `-- local
|       |-- images
|       |-- audio
|       |-- video
|       `-- cache
|           `-- assets.cache
`-- index.php
```

### Where you connect front-end & back-end
```
src/
`-- Controller
    |-- BlogController.php
    |-- HomeController.php
    `-- NotFoundController.php
```

### Where your setup framework
```
config/
|-- bootstrap.php
|-- container.php
|-- middleware.php
|-- routes.php
`-- settings.php
```

### Where front-end do their job
```
templates/
|-- assets
|   `-- local
|       |-- js
|       `-- css
|-- blog.html.twig
|-- footer.html.twig
|-- header.html.twig
`-- home.html.twig
```
