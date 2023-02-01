.PHONY: list
list: ## List of all commands available
	@LC_ALL=C $(MAKE) -pRrq -f $(lastword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/(^|\n)# Files(\n|$$)/,/(^|\n)# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$'
install: ## Install the project
	docker run --rm \
		-u "$(id -u):$(id -g)" \
		-v "$(pwd):/var/www/html" \
		-w /var/www/html \
		laravelsail/php81-composer:latest \
		composer install --ignore-platform-reqs
	alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
	cp .env.example .env
	make start
	sail npm install
	sail npm run dev
	sail artisan key:generate
	sail artisan storage:link
	echo " L'app est installée ! Vous devez maintenant créer la base de données et lancer les migrations. (.env) "
start: ## Start the docker containers
	sail up -d
stop: ## Stop the docker containers
	sail stop
restart: ## Restart the docker containers
	sail restart
logs: ## Display the logs of the docker containers
	sail logs -f
down: ## Stop and remove the docker containers
	sail down
migrate: ## Run the migrations
	sail artisan migrate
seed: ## Run the seeders
	sail artisan db:seed --class=ImageSeeder
websocket: ## Start the websocket server
	sail artisan websockets:serve
