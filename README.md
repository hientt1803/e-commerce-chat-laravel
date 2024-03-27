How to setup and run application. 

## Recommend using git batch
## Php version at least 8.2
## Laravel version 10.

## Must do before run application
    - Run apache and php admin in adminstrator mode

### Do this one 👀👀 
    - Open terminal
    - enter to terminal: composer global require laravel/installer
    - enter to terminal: composer install
    - create .env file => copy data from .env.example to .env
    - create a database name e_commerce_app in php admin and import file .sql 
    - enter to terminal: php artisan key:generate
    - enter to terminal: php artisan migrate
    - enter to terminal: php artisan storage:link
    - enter to terminal(Run application): php artisan serve
    - Access to php admin to see username, all role user and customer got password 12345
