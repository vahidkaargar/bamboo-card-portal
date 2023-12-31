## Bamboo Card Portal Api

This is a Laravel package for using Bamboo api

### What is Bamboo

BAMBOO ELECTRONIC CARDS TRADING LLC is one of the leading Digital Prepaid Products Distributor and Rewards fulfillment
agency in the Middle East.

### Requirement

1. This is a Laravel package
2. PHP >= 7.4

### Installation

```bash
composer require "vahidkaargar/bamboo-card-portal"
```

### Environment

You don't need to publish config with adding these constants to `.env` file

```dotenv
BAMBOO_SANDBOX_USERNAME=
BAMBOO_SANDBOX_PASSWORD=
BAMBOO_SANDBOX_MODE=
BAMBOO_PRODUCTION_USERNAME=
BAMBOO_PRODUCTION_PASSWORD=
```

### Publish config file

```bash
php artisan vendor:publish --tag=bamboo-config
```

## Documentation

### Initial

```php
/*
 * You have two option to call Bamboo api
 * First way - use helper
 */
$bamboo = bamboo();


/*
 * Second way - call class
 */
use vahidkaargar\BambooCardPortal\Bamboo;
$bamboo = new Bamboo();


/*
 * Bamboo has optional parameters
 * if you enter these parameters, it overwrites on configs
 * @param string username
 * @param string password
 * @param bool sandbox
 */
$bamboo = new Bamboo('username', 'password', true);

// or use helper
$bamboo = bamboo('username', 'password', false);
```

### Catalog

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();
$catalogs = $bamboo->catalogs()->get();
```

### Account

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();
$account = $bamboo->accounts()->get();
```

### Order

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = (new Bamboo())->orders();
 
/*
 * checkout and create an order
 * you can add multiple products
 */
$requestedId = Str::uuid();
$checkout = $bamboo->setRequestId($requestedId)
    ->setAccountId($accountId)
    ->setProducts([
        ["ProductId" => $productId, "Quantity" => $quantity, "Value" => $value],
        ["ProductId" => $productId2, "Quantity" => $quantity2, "Value" => $value2],
        ["ProductId" => $productId3, "Quantity" => $quantity3, "Value" => $value3],
    ])
    ->setProduct($productId4, $quantity4, $value4)
    ->checkout();
 
/*
 * get orders between to date e.g. 2022-05-02
 */
$orders = $bamboo->setStartDate('2022-05-02')
    ->setEndDate('2022-05-20')
    ->get();

/*
 * get orders base on $requestedId, its string
 */
$order = $bamboo->get($requestedId);
```

### Exchange rate

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();
$exchange = $bamboo->exchange()
    ->setBaseCurrency('USD')
    ->setCurrency('EUR')
    ->rate();
```

### Transaction

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();
/*
 * get orders between to date e.g. 2022-05-02
 */
$transactions = $bamboo->transactions()
    ->setStartDate('2022-05-02')
    ->setEndDate('2022-05-20')
    ->get();
```

### Notification

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();

/*
 * get notification 
 */
$notification = $bamboo->notifications()->get();
```

### Test

```bash
./vendor/bin/phpunit
```