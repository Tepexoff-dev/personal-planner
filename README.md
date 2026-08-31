**RUN COMMANDS**
* Clone repository: 
* `git clone git@github.com:Tepexoff-dev/personal-planner.git`
* Copy .env.example to .env
* Start containers
* Install Composer:
  `docker compose exec php composer install`
* Generate an application key:
  `docker compose exec php php artisan key:generate`
* Run migrations:
  `docker compose exec php php artisan migrate`
