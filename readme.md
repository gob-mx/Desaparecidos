<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Integrador

Sistema para integracion de aplicativos para el ISSSTE

git clone https://gitlab.com/issste/arquitectura/integrador.git ./

sudo apt-get install zip unzip

composer install

sudo chmod -R 777 storage/

Configurar la base de datos y crear la base para laravel

cp .env.exmple .env

setear:

```
APP_NAME=Integrador
APP_DEBUG=true
APP_URL=http://192.168.15.11/
```



```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=integrador
DB_USERNAME=root
DB_PASSWORD=kls2qr824
```


```
SLOGAN_NAME = "Interoperabilidad institucional"
DIR_FILES = /var/www/integrador/
LOGIN_EXT_LOC = LOCAL
```




php artisan migrate:fresh

php artisan db:seed

sudo chmod -R 777 public/tmp/

sudo chmod -R 777 public/plugs/cache/


Error:

`Deprecation Notice: Class Egulias\EmailValidator\Exception\ExpectedQPair located in ./vendor/egulias/email-validator/EmailValidator/Exception/ExpectingQPair.php does not comply with psr-4 autoloading standard. It will not autoload anymore in Composer v2.0. in phar:///usr/local/bin/composer/src/Composer/Autoload/ClassMapGenerator.php:201`

FIX:

en: 
`egulias/email-validator/Exception/ExpectingQPair.php`

cambiar:
`namespace Egulias\EmailValidator\Exception;`
por:
`namespace Egulias\Exception;`

