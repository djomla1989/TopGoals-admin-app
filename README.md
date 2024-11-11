- Create project

    `curl -s https://laravel.build/example-app | bash`


- In `.env` add this 
    
    `COMPOSE_PROJECT_NAME=top-gloas-admin`


- change ports in docker-compose.yml, and also add `- shared_network` for accesing mongodb, if not in this project
 
  `sail up -d`

  `sail artisan sail:publish`


- Change docker/8.3/Dockerfile --> add `mongodb` package

    `sail build --no-cache`


- edit `.env` file for ports and localhost

    Access http://local.topgoals.test:82/


- do migrate
  `sail artisan migrate`


- install filamentphp 
    `sail composer require filament/filament`
    `sail artisan filament:install --panel`
    `sail artisan make:filament-user`


- add mondodb package
    `sail composer require mongodb/laravel-mongodb:^5.1`


- add mongodb connection in `database.php` if needed, and change `.env` for mongodb connection


- Install dependencies

    `sail composer require laravel/pint --dev`

    `sail composer require larastan/larastan --dev`

    `sail composer install`
