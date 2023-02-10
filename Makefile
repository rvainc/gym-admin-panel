ifneq (,$(wildcard ./.env))
    include .env
    export
endif

fp:
	@sudo chown -R user:user ./*
	@sudo chown -R user:www-data ./bootstrap/cache ./storage/app ./storage/framework  ./storage/logs
	@sudo chmod -R g+w ./bootstrap/cache ./storage/app ./storage/framework  ./storage/logs
	@sudo chmod o+w ./storage/ -R

up:
	@docker compose up -d
	@sleep 1
	@clear
	@printf " -> client url: ${APP_URL}\n -> admin url: ${ADMIN_URL}\n"

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

ssr:
	docker compose exec php php artisan inertia:start-ssr
