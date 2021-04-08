# Lumen Blog

## Usage

-   `git clone https://github.com/pudinglabs/lumen-blog.git lumen-blog`
-   `cd lumen-blog`
-   `composer install`
-   `php artisan jwt:secret`
-   `php artisan migrate`
-   `php artisan db:seed`

## Fixer

Please run this command in the root folder to fixing code standart
-   `php-cs-fixer fix .`

## Unit Test

-   `phpunit`

## Start Docker

```bash
# Login
docker login --username=$DOCKER_USER --password=$DOCKER_PASS $DOCKER_HOST

# Run containers in the background
docker-compose up -d

# Build
docker-compose up --build

# Insert into CLI and run PHP artisan command in /var/www
docker-compose exec yii bash

# Show logs
docker-compose logs -f

```
Any changes to the base image container must rebuild
If everything works fine you can access this blog API at [localhost:8181](http://localhost:8181)

## Documentation
After live you can see API documentation at [localhost:8181/api/documentation](http://localhost:8181/api/documentation)

## Task Number 6

```bash
# Register
curl --request POST \
--location 'http://localhost:8181/external/register' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data 'email=eve.holt@reqres.in&password=pistol&password_confirmation=pistol'

# Login
curl --request POST \
--location 'http://localhost:8181/external/login' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data 'email=eve.holt@reqres.in&password=cityslicka'
```

## Task Number 7

```bash
php ArrayFilter.php

# Then result should be like this
#
# Array
# (
#    [0] => 100000
#    [1] => 150000
#    [2] => 200000
# )
```