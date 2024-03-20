How to setup application. 

## Recommended using git batch
## Php version at least 8.2
## Laravel version 10.

### Do this one 👀👀 
    - Open terminal
    - composer global require laravel/installer
    - composer install
    - create .env file => copy data from .env.example to .env
    - php artisan key:generate
    - php artisan migrate
    - php artisan db:seed (for a example login => use .sql file for better data).
    - php artisan storage:link
    - run application: php artisan serve
    - login with a default account and password. 

### Must do before run application
    - Run apache and phpadmin in adminstrator mode
