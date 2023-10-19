> [!WARNING] 
> __Version 2 (Microservice edition) for football-betting |  no longer current, we have developed something new__

# Commands


## Consume messages

```
php bin/console messenger:consume
```


## Data Transfer 

Console command:
```
php bin/console da:ge
```

Schema file: `schema/app.dataprovider.xml`

## phpUnit

```
php vendor/bin/phpunit
```

## mutation tests

```
vendor/bin/infection --only-covered
```

## psalm

```
vendor/bin/psalm
```

# Setup


## Full Docker: 

More info: <https://github.com/football-betting/betting-skeleton>

## Local Docker Setup

###### Technical Requirements

* Install PHP 7.2 or higher and these PHP extensions (which are installed and enabled by default in most PHP 7 installations): Ctype, iconv, JSON, PCRE, Session, SimpleXML, PCOV and Tokenizer;
* Install Composer, which is used to install PHP packages;
* Install Node and npm
* PHP-Extension:
    * curl
    * json
    * soap
* Symfony-CLI (Download): <https://symfony.com/download> for `symfony serve:start`

### Docker-Domains

* App: <http://localhost:8000>

## Init

```
docker-compose pull
docker-compose up -d

symfony serve:start
```

If you want to know if the setup was successful.  
Pleas check whether the tests are successful:
```
php vendor/bin/phpunit
```


### MySQL-Connect

User: root  
Pass: admin  
Port: 3336

## Install component


### php
```shell
sudo apt update -y 
sudo apt install -y python3 libxml2-dev git zip unzip libssl-dev curl
sudo apt install -y php php-cli php-fpm php-redis php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-soap php-bcmath php-dev
```

#### xDebug

```shell
sudo pecl install xDebug

# example last outupt
#
# Build process completed successfully
# Installing '/usr/lib/php/20190902/xdebug.so'
# install ok: channel://pecl.php.net/xdebug-3.0.3
# configuration option "php_ini" is not set to php.ini location
# You should add "zend_extension=/usr/lib/php/20190902/xdebug.so" to php.ini
```

```
# example for php 7.4 and zend_extension=/usr/lib/php/20190902/xdebug.so

echo "zend_extension=/usr/lib/php/20190902/xdebug.so" | sudo tee -a /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.mode=debug" | sudo tee -a /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.discover_client_host=true" | sudo tee -a /etc/php/7.4/mods-available/xdebug.ini
echo "xdebug.start_with_request=yes" | sudo tee -a /etc/php/7.4/mods-available/xdebug.ini

sudo ln -s /etc/php/7.4/mods-available/xdebug.ini /etc/php/7.4/cli/conf.d/20-xdebug.ini
sudo ln -s /etc/php/7.4/mods-available/xdebug.ini /etc/php/7.4/fpm/conf.d/20-xdebug.ini
```


### composer 2

```shell
wget -O composer-setup.php https://getcomposer.org/installer
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
