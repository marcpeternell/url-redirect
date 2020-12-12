include .env

init:
	@docker-compose build && docker-compose up -d && make install-dep && make env-setup && make migrate && make start

install-dep:
	 docker-compose exec app composer install && docker-compose exec app npm install && docker-compose exec app npm run dev

update-dep:
	@docker-compose exec app composer update && docker-compose exec app composer install

start:
	@docker-compose up -d && make url && make ssh

stop:
	@docker-compose stop

remove:
	@docker rm ${APP_NAME}_app ${APP_NAME}_db ${APP_NAME}_webserver ${APP_NAME}_phpmyadmin

ssh:
	@docker exec -it ${APP_NAME}_app /bin/bash

url:
	@echo ------------------------------------
	@echo "\033[92mApp Urls\033[0m"
	@echo APP: ' \t \t ' http://localhost:${DOCKER_NGINX_PORT}
	@echo phpmyadmin:  ' \t '  http://localhost:${DOCKER_PHPMYADMIN_PORT}
	@echo mysql port:  ' \t '  ${DOCKER_MYSQL_PORT}
	@echo ------------------------------------
	@open http://localhost:${DOCKER_NGINX_PORT} && open http://localhost:${DOCKER_PHPMYADMIN_PORT}

env-setup:
	 @cp .env ./src/.env

migrate:
	@docker-compose exec app php artisan migrate