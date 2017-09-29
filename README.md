# PhpMongodbClientBundle
A Symfony bundle for MongoDB. Compatible with new [mongodb](https://pecl.php.net/package/mongodb) driver, unlike the [doctrine/mongodb](https://packagist.org/packages/doctrine/mongodb) which is compatible only with deprecated and no longer supported [mongo](https://pecl.php.net/package/mongo) driver. 

See: [https://docs.mongodb.com/ecosystem/drivers/php/#compatibility](https://docs.mongodb.com/ecosystem/drivers/php/#compatibility)

## Installation and configuration

### Step 1: Install bundle

Install bundle using [composer](https://getcomposer.org):

```
php composer.phar require "ulff/php-mongodb-client-bundle:dev-master"
```

Enable the bundle in AppKernel.php:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new Ulff\PhpMongodbClientBundle\UlffPhpMongodbClientBundle(),
    ];

    // ...
}
```

### Step 2: add bundle configuration

Add configuration to config.yml. Minimal required is:

```yaml
# app/config/config.yml

ulff_php_mongodb_client:
    connection:
        host: hostname-here
```

There are also other configuration options, like:

```yaml
# app/config/config.yml

ulff_php_mongodb_client:
    connection:
        host: hostname-here
        port: 27017               # optional, default 27017
        username: username-here   # optional, default not set
        password: password-here   # optional, default not set
    options: { }
        # any custom connection options here, passed as assoc array
```

Replace values with proper ones.

## Usage

#### Client usage

Mongodb client is available as a service:

```php
$client = $this->get('ulff_php_mongodb_client.client');
```

#### Getting manager

Service provides access to the mongodb manager:

```php
$manager = $this->get('ulff_php_mongodb_client.client')->getManger();
```
