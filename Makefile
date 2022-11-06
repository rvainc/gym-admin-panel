fp:
	sudo chown -R user:user ./app
	sudo chown -R user:user ./database

up:
	docker compose up -d

down:
	docker compose down

update:
	make down
	make up

php:
	docker compose exec php bash

ps:
	docker compose ps

npm-install:
	make down
	docker compose run node npm i $(f) $(p)
	make up

npm-remove:
	make down
	docker compose run node npm r $(f) $(p)
	make up

git-commit-push:
	make down
	git add .
	git commit -m "$(m)"
	git push

git-commit:
	make down
	git add .
	git commit -m "$(m)"

exec-node:
	docker compose exec node bash

run-node:
	docker compose run node bash
