docker-build:
	docker compose up -d --build

docker-up:
	docker compose up -d

docker-down:
	docker compose down

bash:
	make docker-up
	docker compose exec app bash