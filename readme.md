## Bamboo Card Portal Api

Bamboo

### Requirement
1. This is a Laravel package
2. PHP >= 7.4

### Installation
```bash
composer require "vahidkaargar/bamboo-card-portal"
```

### Publish config file
```bash
php artisan vendor:publish --tag=bamboo-config
```

## Documentation
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
$account = $bamboo->account()->get();
```

### Order
```php
use vahidkaargar\BambooCardPortal\Bamboo;


$bamboo = (new Bamboo())->orders();
 
 /*
 * checkout and create an order
 */
 $requestedId = Str::uuid();
 $checkout = $bamboo->setRequestId($requestedId)
    ->setAccountId($accountId)
    ->setProducts($productId, $quantity, $value)
    ->setProducts($productId2, $quantity2, $value2)
    ->setProducts($productId3, $quantity3, $value3)
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
$account = $bamboo->exchange()
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
$orders = $bamboo->transactions()
    ->setStartDate('2022-05-02')
    ->setEndDate('2022-05-20')
    ->get();
```

### Notification
```php
$bamboo = new Bamboo();

/*
 * get notification 
 */
$notification = $bamboo->notification()->get();
```