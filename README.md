# bussiness01 project

#### 1. Environment
```sh
- composer 
  |-version : 2.5.8
  |-link dowload : https://getcomposer.org/download/
  
- php
  |-version : 8.2.8
  |-link dowload : https://www.php.net/downloads.php
  
- laravel 
  |-version : 10.18.0
  |-link dowload : https://laravel.com/docs/10.x
```
#### 2. Source code:
Url git:
```sh
https://github.com/longanphp/bussiness_1
```

Build vendor (after cd into the directory containing the project):
```sh
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

