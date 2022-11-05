chown-app:
	sudo chown -R user:user ./app

up:
	docker compose up -d

down:
	docker compose down

php:
	docker compose exec php bash

node:
	docker compose run node bash

ps:
	docker compose ps

npm-install:
	make down
	docker compose run node npm i $(flags) $(packages)
	make up

npm-remove:
	make down
	docker compose run node npm r $(flags) $(packeges)
	make up

git-commit-push:
	make down
	git add .
	git commit -m "$(m)"
	git push
