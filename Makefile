.PHONY: assets install tests start image-build image-push image-pull requirements analyse docker-run run start-dev stop stop-dev composer cs csf qa

COMPOSER_HOME ?= $(HOME)/.config/composer
COMPOSER_CACHE_DIR ?= $(HOME)/.cache/composer
MAKEFLAGS += --no-print-directory
CONTAINER := $(shell command -v podman >/dev/null 2>&1 && echo podman || echo docker)
VOLUME_SUFFIX := $(if $(filter $(CONTAINER),podman),:z,)

assets:
	npx vite build

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

start:
	$(CONTAINER) compose up -d
start-dev:
	$(CONTAINER) compose -f docker-compose.dev.yml up -d
stop:
	$(CONTAINER) compose stop
stop-dev:
	$(CONTAINER) compose -f docker-compose.dev.yml stop

run:
	$(MAKE) docker-run CMD="$(filter-out $@,$(MAKECMDGOALS))"


install:
	$(MAKE) docker-run CMD="composer update $(filter-out $@,$(MAKECMDGOALS))"

requirements:
	$(MAKE) image-pull
	$(MAKE) install
	[ -f vendor/bin/phpstan ] && chmod +x vendor/bin/phpstan || true
	chmod -R a+rw temp log
	$(MAKE) assets

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