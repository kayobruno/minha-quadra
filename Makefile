UID := $(shell id -u)
GID := $(shell id -g)

DB_FILE=./database/database.sqlite

serve:
	- docker-compose up

build:
	- docker-compose build

test: migrate
	- docker-compose exec php bash -c "composer test:all"

bash:
	- docker-compose exec -u ${UID}:${GID} php bash

migrate: create-test-db-file
	@echo "Running migrations..."
	- docker-compose exec -u ${UID}:${GID} php php artisan migrate --env=testing --force

create-test-db-file:
	@echo "Creating SQLite database file..."
	@if [ ! -f $(DB_FILE) ]; then \
		touch $(DB_FILE); \
		chmod 777 $(DB_FILE); \
		echo "SQLite database file created."; \
	fi
