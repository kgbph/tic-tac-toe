install:
	cp -n .env.local .env
	cp -n docker-compose.dev.yml docker-compose.override.yml
	docker compose up -d --build
	docker compose exec web chown -R www-data:www-data bootstrap/ storage/
	docker compose exec web composer install

test:
	docker compose exec php composer check
