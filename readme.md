# PHP CRUD API with QraphQL
- A Simple crud api using GraphQL with lighthouse library and GraphQL playground

# Technology

- Laravel Framework v5.8

- Docker v19.03.1

- PHP v7.1.3

- LightHouse v3.1 for building the graphql server

- Data was persisted with Sqlite
        
- Nginx as the reverse proxy server        

- Testing was done with PhpUnit

# Main Packages

- This can be found in the composer.json in the root directory of the project

- PhpUnit 7.5 was used for testing , i am more familiar with this than others like Codeception and Behat


# To run using docker [Recommended]

- Git clone this repository
- Change directory into root of cloned folder
- Rename `.env.example`  to `.env` (This contains the app configs and databases settings )
- Enter `sh ./start.sh` to start the 3 docker containers ( php , nginx and mysql )
- Open http://localhost:8000 or http://[local ipaddress]:8000 to use the graphql playground

# To run locally without docker

- Git clone this repository
- Change directory into root of cloned folder
- Enter `composer install` (assuming you have `composer` and its related packages installed and or configured)
- Rename `.env.example`  to `.env` (This contains the app configs and databases settings)
- Configure your database settings in `.env` or use sqlite
- Enter `php artisan serve` to start application
- Enter `php artisan migrate` to run migration 
- Enter `php artisan db:seed` to run seed some some records 
- Run tests with `composer test`
- Open ttp://localhost:8000 or http://127.0.0.1:8000 to view app
 

# Data Migration

- This is found in database/migrations/ in the root directory of the project

# Routes

- This can be found in routes/web.php in the root directory of the project 
 