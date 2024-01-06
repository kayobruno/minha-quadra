UID := $(shell id -u)
GID := $(shell id -g)

serve:
	- docker-compose up

test.feature:
	- docker-compose exec -u ${UID}:${GID} php bash -c "composer test:feature"

test.unit:
	- docker-compose exec -u ${UID}:${GID} php bash -c "composer test:unit"

test.all:
	- docker-compose exec -u ${UID}:${GID} php bash -c "composer test:all"

bash:
	- docker-compose exec php bash
