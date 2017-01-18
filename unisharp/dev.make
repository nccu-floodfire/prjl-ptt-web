#!/usr/bin/make -f
UNAME := $(shell uname)
APACHEUSER=www-data
NOW_DATETIME = $(shell date +"%Y-%m-%d_%H:%M:%S")
PROJECT_NAME = $(shell basename $(DEPLOY_PATH))
WWW_ROOT ?= ./

ifndef DEPLOY_PATH
DEPLOY_PATH = ./_DEPLOY
endif

ifeq (,$(wildcard $(DEPLOY_PATH)/.rev))
BACKUP_NAME=_BACKUP-$(PROJECT_NAME)-$(NOW_DATETIME)
else
REV=$(shell cat $(DEPLOY_PATH)/.rev)
BACKUP_NAME=_BACKUP-$(PROJECT_NAME)-$(NOW_DATETIME)-$(REV)
endif

ifeq ($(UNAME), Darwin)
APACHEUSER=_www
endif

ifeq ($(wildcard /opt/u/etc/environment),)
MACHINE_ENV=unknown
else
MACHINE_ENV=$(shell cat /opt/u/etc/environment)
endif

all::
	@echo "all"


initdb::
	@echo This is environment $(MACHINE_ENV)
ifeq ($(MACHINE_ENV),$(filter $(MACHINE_ENV), local testing alpha))
	mysql -u root < ./_INSTALL/data.sql
	mysql -u root < ./_INSTALL/permission.sql
endif

init::
	@echo "init"

de-permission::
	sudo chown -R ${APACHEUSER} ./

en-permission::
	sudo chown -R ${USER} ./
	sudo chown -R ${APACHEUSER} ${NEED_PERMISSION_DIRS}

mysqldump::
	mysqldump -u root --extended-insert=false --add-drop-database --database ${DATABASE} --default-character-set=utf8 > ./_INSTALL/data.sql

deploy::
ifeq ($(DEPLOY_PATH),./_DEPLOY)
	@echo deploy to _DEPLOY
	mkdir -p _DEPLOY
	rsync -av --exclude-from="./_EXCLUDE.LIST" --delete ./ ./_DEPLOY
else
	sudo mkdir -p $(DEPLOY_PATH)
	sudo chown -R ${USER} $(DEPLOY_PATH)
	@echo deploy to $(DEPLOY_PATH)
	rsync -av --exclude-from="./_EXCLUDE.LIST" ./ $(DEPLOY_PATH)
	git log --pretty=format:'%h' -n 1 > $(DEPLOY_PATH)/.rev
	for d in ${NEED_PERMISSION_DIRS}; \
		do [ -e $$d ] && sudo chown -R ${APACHEUSER} $(DEPLOY_PATH)/$$d; \
	done
endif

deploy-apache::
	setApache $(SERVER_NAME) $(DOCUMENT_ROOT) $(DIRECTORY)

deploy-dns::
	dnsCreator $(KEY) $(SECRET) $(HOSTED_ZONE_ID) $(ACTION) $(NAME) $(TYPE) $(VALUE)

server::
	php -S localhost:9999 -t $(WWW_ROOT)

serve:: server

env::
	@echo $(MACHINE_ENV)

.PHONY: deploy serve server backup-remote backup deploy-end deploy-apache deploy mysqldump en-permission de-permission init all
