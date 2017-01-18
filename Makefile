NEED_PERMISSION_DIRS=./app/storage ./public/upload
WWW_ROOT=./public
PRJ_NAME=prjl-ptt-web
DATABASE=$(PRJ_NAME)

ifndef USER_DOMAIN
  USER_DOMAIN=$(PRJ_NAME)
endif

ifndef PROD_DB_PASSWORD
  PROD_DB_PASSWORD=temp
endif

include unisharp/dev.make

all:: update

laravel-initdb::
	rm -f app/database/local.sqlite && touch app/database/local.sqlite

laravel-initdb-mysql-local::
	sed 's/{dbname}/$(PRJ_NAME)/g' _INSTALL/data.sql > _TMP/data.sql
	sed 's/{DOMAIN}/$(PRJ_NAME)/g' _INSTALL/permission.sql > _TMP/permission.sql
	mysql -u root < ./_TMP/data.sql
	mysql -u root < ./_TMP/permission.sql

laravel-initdb-mysql-testing::
ifdef USER_DOMAIN
	mkdir -p _TMP
	cp app/config/alpha/database.php _TMP/database.php.bak
	sed 's/{dbname}/$(USER_DOMAIN)/g' _INSTALL/data.sql > _TMP/data.sql
	sed 's/{DOMAIN}/$(USER_DOMAIN)/g' _INSTALL/permission.sql > _TMP/permission.sql
	sed 's/{DOMAIN}/$(USER_DOMAIN)/g' app/config/alpha/database.php > _TMP/database.php
ifeq ($(APP_ENV),production)
	sed 's/{DOMAIN}/$(USER_DOMAIN)/g' app/config/production/database.php > _TMP/database.production.php
	mysql -u root -p$(PROD_DB_PASSWORD) < ./_TMP/data.sql
	mysql -u root -p$(PROD_DB_PASSWORD) < ./_TMP/permission.sql
	cp _TMP/database.production.php app/config/production/database.php
else
	mysql -u root < ./_TMP/data.sql
	mysql -u root < ./_TMP/permission.sql
	cp _TMP/database.php app/config/alpha/database.php
endif
endif

init-template::
	cp -rf _unisharp-template/* us/dollar/generators/src/Dollar/Generators/Generators/templates/scaffold/

prepare::
	npm install
	composer install

npm-build::
	npm run build


# FIXME: protection for running this on production
init:: laravel-initdb-mysql-local

update:: prepare npm-build
	composer dump-autoload -o
	php artisan optimize
	php artisan migrate


do:: npm-build
	php artisan migrate
	php artisan db:seed

undo:: laravel-initdb
