init: docker-build docker-up composer-install

docker-build:
	docker-compose build

docker-build-nocache:
	docker-compose build --no-cache

docker-up:
	docker-compose up -d

composer-install:
	docker-compose run --rm php-cli composer install