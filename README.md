# Bus booking system

## Installation

## Docker

To install with Docker [laravel sail](https://laravel.com/docs/9.x/sail), run following commands:
    (please note it may take several minutes only in the first time to build containers)

```
git clone git@github.com:kh-hossam/bus-booking-system-laravel.git
cd bus-booking-system-laravel

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

./vendor/bin/sail up -d
cp .env.example .env
./vendor/bin/sail artisan key:generate

```

----------

# APIS

all apis exists in postman collection in project root, you can import it to easily test the apis 
