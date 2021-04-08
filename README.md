# Lumen Blog

## Usage

-   `git clone https://github.com/pudinglabs/lumen-blog.git lumen-blog`
-   `cd lumen-blog`
-   `composer install`
-   `php artisan jwt:secret`
-   `php artisan migrate`
-   `php artisan db:seed`

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