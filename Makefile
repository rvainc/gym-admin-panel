ifneq (,$(wildcard ./.env))
    include .env
    export
endif

fp:
	@sudo chown -R user:user ./app
	@sudo chown -R user:user ./database

up:
	@docker compose up -d
	@printf "client url: ${APP_URL}\n"
	@printf "admin url: ${ADMIN_URL}\n"

down:
	@docker compose down

update:
	@make down
	@make up

php:
	@docker compose exec php bash

ps:
	@docker compose ps

exec-node:
	@docker compose exec node bash

run-node:
	@docker compose run node bash
