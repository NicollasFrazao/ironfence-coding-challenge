include .env

sail="./vendor/bin/sail"

install:
	composer install

build:
	${sail} up --build

up:
	${sail} up

down:
	${sail} down

start:
	${sail} up -d

stop:
	${sail} stop

restart:
	${sail} restart

sh:
	${sail} exec application bash

sh\:application:
	${sail} exec application bash

sh\:mysql:
	${sail} exec mysql bash -c 'mysql -h ${DB_HOST} --port=${DB_PORT} -u ${DB_USERNAME} -p${DB_PASSWORD} ${DB_DATABASE}'

npm:
	npm install && npm run dev

migrate:
	${sail} artisan migrate

seed:
	${sail} artisan migrate --seed

test:
	${sail} test