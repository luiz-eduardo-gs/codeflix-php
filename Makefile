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