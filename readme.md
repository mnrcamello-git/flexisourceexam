### After pull ###
composer install
php artisan migrate (users and customers table will be added)
chown -R www-data storage/
uncomment $app->withEloquent(); -> bootstrap/app.php

### Technologies used ###
It uses Guzzle which is already included in composer.json file. Just simply run composer install first.
Version used: Laravel Framework Lumen (5.7.8) (Laravel Components 5.7.*) 
PHP 7.3
Artisan Development (Building A Command)
Model Eloquent ORM
Repository Pattern


### Syntax ###
commands:
php artisan import:posts -> Console based command to run import on https://randomuser.me endpoint to local database table