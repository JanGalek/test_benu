.PHONY: install tests start image-build image-push image-pull requirements analyse docker-run docker-npm-run run start-dev stop stop-dev composer cs csf qa npm

COMPOSER_HOME ?= $(HOME)/.config/composer
COMPOSER_CACHE_DIR ?= $(HOME)/.cache/composer
MAKEFLAGS += --no-print-directory
CONTAINER := $(shell command -v podman >/dev/null 2>&1 && echo podman || echo docker)
VOLUME_SUFFIX := $(if $(filter $(CONTAINER),podman),:z,)

image-build:
	$(CONTAINER) build -t gouef/php-xdebug:8.4-latest ./.docker/xdebug/8.4
	$(CONTAINER) tag localhost/gouef/php-xdebug:8.4-latest gouef/php-xdebug:8.4-latest
	$(CONTAINER) tag localhost/gouef/php-xdebug:8.4-latest docker.io/gouef/php-xdebug:8.4-latest
image-push:
	$(CONTAINER) push docker.io/gouef/php-xdebug:8.4-latest
image-pull:
	$(CONTAINER) pull docker.io/gouef/php-xdebug:8.4-latest

docker-run:
	$(CONTAINER) run --rm -it \
			--tty --interactive \
            --env COMPOSER_HOME=$(COMPOSER_HOME) \
            --env COMPOSER_CACHE_DIR=$(COMPOSER_CACHE_DIR) \
            --volume $(COMPOSER_HOME):$(COMPOSER_HOME)$(VOLUME_SUFFIX) \
            --volume $(COMPOSER_CACHE_DIR):$(COMPOSER_CACHE_DIR)$(VOLUME_SUFFIX) \
            --volume $(CURDIR):/app$(VOLUME_SUFFIX) \
            docker.io/gouef/php-xdebug:8.4-latest $(CMD)

docker-node-run:
	mkdir -p ~/.npm
	$(CONTAINER) run -it \
			--tty --interactive \
            --volume $(CURDIR):/usr/src/app$(VOLUME_SUFFIX) \
            -w /usr/src/app \
            --user $(id -u):$(id -g) \
            docker.io/node:latest sh -c "$(CMD)"

start:
	$(CONTAINER) compose up -d
start-dev:
	$(CONTAINER) compose -f docker-compose.dev.yml up -d
stop:
	$(CONTAINER) compose down
stop-dev:
	$(CONTAINER) compose -f docker-compose.dev.yml down

run:
	$(MAKE) docker-run CMD="$(filter-out $@,$(MAKECMDGOALS))"

npm:
	$(MAKE) docker-node-run CMD="npm $(filter-out $@,$(MAKECMDGOALS))"

npm-install:
	$(MAKE) docker-node-run CMD="npm install $(filter-out $@,$(MAKECMDGOALS))"

vite-build:
	$(MAKE) docker-node-run CMD="npx vite build $(filter-out $@,$(MAKECMDGOALS))"

npx:
	$(MAKE) docker-node-run CMD="npx $(filter-out $@,$(MAKECMDGOALS))"

install:
	$(MAKE) docker-run CMD="composer update $(filter-out $@,$(MAKECMDGOALS))"
	npm install

requirements:
	$(MAKE) image-pull
	$(MAKE) install
	[ -f vendor/bin/phpstan ] && chmod +x vendor/bin/phpstan || true
	rm -R -f temp/cache
	chmod -R a+rw temp log
	$(MAKE) vite-build

composer:
	$(MAKE) docker-run CMD="composer $(filter-out $@,$(MAKECMDGOALS))"

tests:
	@rm -rf .phpunit.result.cache .phpunit.cache coverage && $(MAKE) docker-run CMD="vendor/bin/phpunit ./tests/unit $(filter-out $@,$(MAKECMDGOALS))"

analyse:
	$(MAKE) docker-run CMD="vendor/bin/phpstan $(filter-out $@,$(MAKECMDGOALS))"

cs:
	$(MAKE) docker-run CMD="vendor/bin/phpcs --standard=ruleset.xml app tests $(filter-out $@,$(MAKECMDGOALS))"

csf:
	$(MAKE) docker-run CMD="vendor/bin/phpcbf --standard=ruleset.xml app tests $(filter-out $@,$(MAKECMDGOALS))"

qa:
	$(MAKE) cs
	$(MAKE) analyse

%:
	@: