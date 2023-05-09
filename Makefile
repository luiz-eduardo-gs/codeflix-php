docker-build:
	docker compose up -d --build

docker-up:
	docker compose up -d

docker-down:
	docker compose down

docker-bash:
	docker compose exec app bash

docker-test:
	docker compose exec app php artisan test

docker-db:
	docker compose exec db mysql -uroot -p

copy-env:
	cp .env.example .env

laravel-key-generate:
	docker compose exec app php artisan key:generate

composer-install:
	docker compose exec app composer install

docker-setup: docker-build composer-install copy-env laravel-key-generate docker-test
