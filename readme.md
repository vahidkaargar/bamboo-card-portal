## Bamboo Card Portal API for Laravel

**Bamboo Card Portal API** is a Laravel package that offers seamless integration with the Bamboo API. Bamboo is a trusted provider of digital prepaid products and reward fulfillment services, making it a valuable solution for businesses operating in the Middle East.


## Table of Contents

- [About Bamboo](#about-bamboo)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Using the Helper Function](#1-using-the-helper-function)
    - [Using the Bamboo Class Directly](#2-using-the-bamboo-class-directly)
    - [Catalogs](#catalogs)
    - [Account](#account)
    - [Order](#order)
    - [Exchange rate](#exchange-rate)
    - [Transaction](#transaction)
    - [Notification](#notification)
    - [Test](#test)
  


### About Bamboo

BAMBOO ELECTRONIC CARDS TRADING LLC is a leading distributor of digital prepaid products and a recognized rewards fulfillment agency. This package simplifies the interaction with their platform, enabling developers to manage and distribute digital products effectively.

### Requirements

1. Laravel Framework: 8.x or higher
2. PHP: 7.4 or higher
3. Composer: Latest version

### Installation
To install the Bamboo Card Portal API package, use the following Composer command:
```bash
composer require "vahidkaargar/bamboo-card-portal"
```

### configuration

After installation, configure the package by setting the following environment variables in your Laravel project's `.env` file:

```dotenv
BAMBOO_SANDBOX_USERNAME=
BAMBOO_SANDBOX_PASSWORD=
BAMBOO_SANDBOX_MODE=
BAMBOO_PRODUCTION_USERNAME=
BAMBOO_PRODUCTION_PASSWORD=
# In seconds
BAMBOO_CONNECTION_TIMEOUT=360
```

### Publish config file
This will generate a configuration file at `config/bamboo.php`, where you can further customize the settings. (Like Sandbox etc.)
```bash
php artisan vendor:publish --tag=bamboo-config
```

### Usage

There are two primary ways to use this package:

#### 1. Using the Helper Function
```php
$bamboo = bamboo();
$bamboo = bamboo('username', 'password', false);
```

#### 2. Using the Bamboo Class Directly
```php
use vahidkaargar\BambooCardPortal\Bamboo;
$bamboo = new Bamboo();
$bamboo = new Bamboo('username', 'password', true);
```

### Catalogs
Catalogs have two versions
```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();

// Version 1
$catalogs = $bamboo->catalogs()->get();

// Version 2
$catalogs = $bamboo->catalogs()
    ->setVersion(2)
    ->setName('playstation germany')
    ->setProductId(114111)
    ->setBrandId(100)
    ->setCountryCode('US')
    ->setCurrencyCode('USD')
    ->setModifiedDate('2022-08-21')
    ->setPageIndex(default: 0)
    ->setPageSize(default: 150)
    ->get();
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
For create a notification listener:
- You must set a callback URL address from your website
- You must set a secret key for passing the right notifications
```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();

/*
 * get notification that you created
 */
$notification = $bamboo->notifications()->get();

/*
 * create notification listener
 */
$notification = $bamboo->notifications()
    ->setNotificationUrl('https://your-website.com/notification-listener')
    ->setSecretKey('your-secret-key')
    ->create();
```

### Test

```bash
./vendor/bin/phpunit
```