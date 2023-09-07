## Setup dev environment

1. Create project folder

Pull this repo to your local environment
```shell
git clone git@github.com:RettyInc/partner-hare-inbound-be.git
```

2. Startup containers
- Create file `.env` to setup environment variables, the example is already in `.env.example` file, change anything you want
```shell
cp .env.example .env
```

- Included services:
  - `php8.1` (web server)
  - `mysql` (database)
  - `composer` (run composer command)
  - `nodejs` (run npm command)

3. Install php dependencies (composer)
Run command `composer`
```shell
composer install
```

4. Run migrations
Run command using `php`.
```shell
php artisan migrate
```

5. Seed data
Run command using `php`.
```shell
php artisan db:seed
```

6. Install js dependencies
Run command using `npm`
```shell
npm install
```

7. Build assets for the application (js, css)
Run command using `npm`
```shell
npm run build
```

8. Open up web server
Run command using `php`
```shell
php artisan ser
```

9. Open browser to test the site
```
http://127.0.0.1:8000
```


## Check source code:
- PHP mess detector: `./vendor/bin/phpmd app,database,routes,tests text phpmd.xml`
- PHP_CodeSniffer: `./vendor/bin/phpcs`

## Generate Swagger document

```
$ php artisan l5-swagger:generate
```

## Api Documents

http://localhost:8000/api/documentation
## Technical support

## How to run unit test
1. Create `.env.testing`
```
$ cp .env.example .env.testing
```
2. Create DB testing
3. Config `.env.testing` and cache
```
$ php artisan config:cache --env=testing
```
4. Config `phpunit.xml`
5. Run test database migrate
```
$ php artisan migrate --env=testing
```
6. Run Unit test
```
$ ./vendor/bin/phpunit
```
7. Run test coverage
```
$ ./vendor/bin/phpunit --coverage-html coverage
```

## How to run queue 
1. Config .env `QUEUE_CONNECTION=database`
1. Config .env `QUEUE_DRIVER=database`
2. Create table `job`, `failed_job` if not already.
```
$ php artisan queue:table
$ php artisan queue:failed-table
$ php artisan migrate
```
3. Install supervisor 
```
$ sudo apt-get install supervisor
```
4. Create file `queue-worker.conf` in `etc/supervisor/conf.d`
```
[program:queue-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/partner-hare-inbound/backend/artisan queue:work --queue=send_register --tries=3
autostart=true
autorestart=true
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/partner-hare-inbound/backend/storage/logs/queue_worker.log
```
5. cd to project `/var/www/partner-hare-inbound/backend` and Run command
```
$ sudo supervisorctl reread
$ sudo supervisorctl update
$ sudo service supervisor restart
```

## Add queue to `queue-worker.conf` on supervisor
1. Add name queue to command queue
--queue=send_register
2. Reset supervisor
