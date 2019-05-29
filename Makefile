
init :
	composer self-update
	composer global update
	composer update
	yarn install

version :
	php --version
	composer --version

validate:
	composer -vv validate --strict -vv --with-dependencies

clean:
	bin/console cache:clear --env=test
	bin/console cache:clear --env=dev

stan:
	if [ ! -d "var/cache/phpunit" ]; then vendor/bin/simple-phpunit install -v; fi
	phpstan analyse src tests --level max

cs:

	php-cs-fixer fix

asset:
	yarn run encore dev

############################################
#               S E R V E R                #
############################################

start:
	bin/console server:start

stop:
	bin/console server:stop

restart: stop start

status:
	bin/console server:status

############################################
#             D A T A B A S E              #
############################################

dbdrop:
	bin/console doctrine:database:drop --force

dbinit:
	bin/console doctrine:database:create
	bin/console doctrine:schema:create --no-interaction

dbreset: dbdrop dbinit

fixtures:
	bin/console doctrine:fixtures:load

############################################
#               T R A V I S                #
############################################

# dev or stable
# =============
dev:
	composer config minimum-stability dev
stable:
	composer config minimum-stability stable

# test
# ====
test:
	vendor/bin/simple-phpunit -v
cover-text:
	vendor/bin/simple-phpunit -v --coverage-text
cover: clean
	vendor/bin/simple-phpunit --coverage-html var/test-coverage
