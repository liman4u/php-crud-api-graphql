#!/bin/bash

docker-compose down

docker-compose up -d --build

>&2 echo "Waiting for application to run. Please wait....."
sleep 10
>&2 echo "Application started :)"

docker-compose exec app php artisan migrate
>&2 echo "Application database migration done..."

docker-compose exec app php artisan db:seed
>&2 echo "Application database seeding done..."

docker-compose exec app composer test
>&2 echo "Application tests done..."

>&2 echo "Application is now ready at http://localhost:8000"
sleep 3
exit 0