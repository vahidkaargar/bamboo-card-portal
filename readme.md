# Bamboo Card Portal Laravel Package

A professional Laravel package for seamless integration with the Bamboo Card Portal API. This package provides a robust, well-tested solution for interacting with Bamboo's services, featuring comprehensive exception handling, intelligent caching, Laravel facades, and extensive test coverage.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
  - [Environment Variables](#environment-variables)
- [Usage](#usage)
  - [Basic Usage](#basic-usage)
  - [Using the Facade](#using-the-facade)
  - [Exception Handling](#exception-handling)
  - [Caching](#caching)
  - [Configuration Options](#configuration-options)
- [API Methods](#api-methods)
  - [Orders](#orders)
  - [Catalogs](#catalogs)
  - [Accounts](#accounts)
  - [Exchange](#exchange)
  - [Transactions](#transactions)
  - [Notifications](#notifications)
- [Testing](#testing)
- [Exception Types](#exception-types)
- [Cache Configuration](#cache-configuration)
- [Version 2 API](#version-2-api)
- [Contributing](#contributing)
- [License](#license)
- [Changelog](#changelog)
  - [Version 2.0.0](#version-200)
  - [Version 1.0.0](#version-100)
- [Support](#support)

## Features

- **Easy Integration**: Simple API for interacting with Bamboo Card Portal
- **Exception Handling**: Comprehensive exception layer with specific exception types
- **Caching**: Optional caching with configurable drivers and TTL
- **Facade Support**: Laravel facade for easy access
- **Comprehensive Testing**: Full test suite with unit and integration tests
- **Configuration**: Flexible configuration with environment variables
- **Security**: Built-in authentication and validation
- **Laravel 12 Compatible**: Full support for Laravel 5.x through 12.x

## Requirements

- PHP >= 8.2
- Laravel 5.x, 6.x, 7.x, 8.x, 9.x, 10.x, 11.x, or 12.x

## Installation

Install the package via Composer:

```bash
composer require vahidkaargar/bamboo-card-portal
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --provider="vahidkaargar\BambooCardPortal\ServiceProviders\BambooServiceProvider" --tag="bamboo-config"
```

### Environment Variables

Configure your environment variables in `.env`:

```env
# Sandbox Configuration
BAMBOO_SANDBOX_MODE=true
BAMBOO_SANDBOX_USERNAME=your_sandbox_username
BAMBOO_SANDBOX_PASSWORD=your_sandbox_password

# Production Configuration
BAMBOO_PRODUCTION_USERNAME=your_production_username
BAMBOO_PRODUCTION_PASSWORD=your_production_password

# Cache Configuration
BAMBOO_CACHE_ENABLED=true
BAMBOO_CACHE_DRIVER=default
BAMBOO_CACHE_PREFIX=bamboo
BAMBOO_CACHE_TTL=3600

# Connection Configuration
BAMBOO_CONNECTION_TIMEOUT=160
```

## Usage

### Basic Usage

```php
use vahidkaargar\BambooCardPortal\Bamboo;

$bamboo = new Bamboo();

// Get orders
$orders = $bamboo->orders()
    ->setStartDate('2023-01-01')
    ->setEndDate('2023-01-31')
    ->get();

// Get specific order
$order = $bamboo->orders()->get('order-id');

// Create order
$bamboo->orders()
    ->setRequestId('unique-request-id')
    ->setAccountId(123)
    ->setProducts([
        ["ProductId" => $productId, "Quantity" => $quantity, "Value" => $value],
        ["ProductId" => $productId2, "Quantity" => $quantity2, "Value" => $value2],
        ["ProductId" => $productId3, "Quantity" => $quantity3, "Value" => $value3],
    ])
    ->setProduct($productId4, $quantity4, $value4)
    ->checkout();
```

### Using the Facade

```php
use Bamboo;

// All methods are available through the facade
$orders = Bamboo::orders()->get();
$catalogs = Bamboo::catalogs()->get();
$accounts = Bamboo::accounts()->get();
```

### Exception Handling

The package provides specific exceptions for different error scenarios:

```php
use vahidkaargar\BambooCardPortal\Exceptions\{
    AuthenticationException,
    ConfigurationException,
    NetworkException,
    ResourceNotFoundException,
    ValidationException
};

try {
    $orders = $bamboo->orders()->get();
} catch (AuthenticationException $e) {
    // Handle authentication errors
    logger('Authentication failed: ' . $e->getMessage());
} catch (ResourceNotFoundException $e) {
    // Handle resource not found errors
    logger('Resource not found: ' . $e->getMessage());
} catch (ValidationException $e) {
    // Handle validation errors
    $errors = $e->getErrors();
    logger('Validation errors: ' . json_encode($errors));
} catch (NetworkException $e) {
    // Handle network errors
    logger('Network error: ' . $e->getMessage());
}
```

### Caching

The package includes optional caching functionality:

```php
// Cache is enabled by default
$orders = $bamboo->orders()->get(); // This will be cached

// Disable caching in config
// BAMBOO_CACHE_ENABLED=false

// Use different cache driver
// BAMBOO_CACHE_DRIVER=redis
```

### Configuration Options

```php
// config/bamboo.php
return [
    'sandbox_mode' => env('BAMBOO_SANDBOX_MODE', true),
    
    // Sandbox credentials
    'sandbox_username' => env('BAMBOO_SANDBOX_USERNAME'),
    'sandbox_password' => env('BAMBOO_SANDBOX_PASSWORD'),
    'sandbox_base_url' => 'https://api-stage.bamboocardportal.com/api/integration/v1.0/',
    
    // Production credentials
    'production_username' => env('BAMBOO_PRODUCTION_USERNAME'),
    'production_password' => env('BAMBOO_PRODUCTION_PASSWORD'),
    'production_base_url' => 'https://api.bamboocardportal.com/api/integration/v1.0/',
    'production_v2_base_url' => 'https://api.bamboocardportal.com/api/integration/v2.0/',
    
    // Connection settings
    'connection_timeout' => env('BAMBOO_CONNECTION_TIMEOUT', 160),
    
    // Cache settings
    'cache' => [
        'enabled' => env('BAMBOO_CACHE_ENABLED', true),
        'driver' => env('BAMBOO_CACHE_DRIVER', 'default'),
        'prefix' => env('BAMBOO_CACHE_PREFIX', 'bamboo'),
        'ttl' => env('BAMBOO_CACHE_TTL', 3600),
    ],
];
```

## API Methods

### Orders

```php
$orders = $bamboo->orders();

// Get orders with date range
$orders->setStartDate('2023-01-01')
       ->setEndDate('2023-01-31')
       ->get();

// Get specific order
$orders->get('order-id');

// Create order
$orders->setRequestId('unique-id')
       ->setAccountId(123)
       ->setProduct(1, 5, 100)
       ->checkout();
```

### Catalogs

```php
$catalogs = $bamboo->catalogs();
$products = $catalogs->get();
```

### Accounts

```php
$accounts = $bamboo->accounts();
$account = $accounts->get();
```

### Exchange

```php
$exchange = $bamboo->exchange();
$rates = $exchange->get();
```

### Transactions

```php
$transactions = $bamboo->transactions();
$transaction = $transactions->get();
```

### Notifications

```php
$notifications = $bamboo->notifications();
$notification = $notifications->get();
```

## Testing

Run the test suite:

```bash
composer test
```

The package includes comprehensive tests for:
- Unit tests for all components
- Integration tests for API interactions
- Exception handling tests
- Cache functionality tests
- Facade tests

## Exception Types

- `BambooException`: Base exception class
- `AuthenticationException`: Authentication failures (401)
- `ConfigurationException`: Configuration errors
- `NetworkException`: Network/connection errors
- `ResourceNotFoundException`: Resource not found (404)
- `ValidationException`: Validation errors (422)

## Cache Configuration

The package supports various cache drivers:

- `array`: Default in-memory cache
- `redis`: Redis cache
- `database`: Database cache
- `file`: File-based cache

## Version 2 API

Switch to version 2 of the API:

```php
$bamboo = new Bamboo();
$bamboo->version2(); // Switch to v2 API
```

## Contributing

We welcome contributions to improve this package. Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Write tests for your changes
4. Ensure all tests pass (`composer test`)
5. Commit your changes (`git commit -m 'Add some amazing feature'`)
6. Push to the branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Changelog

### Version 2.0.0
- Added Laravel 12 compatibility
- Implemented comprehensive exception handling system
- Added intelligent caching with configurable drivers
- Introduced Laravel facade for improved developer experience
- Enhanced test coverage with unit and integration tests
- Improved error handling and validation
- Added support for multiple cache drivers (Redis, Database, File, Array)

### Version 1.0.0
- Initial release with basic API integration
- Support for orders, catalogs, accounts, exchange, transactions, and notifications
- Basic configuration management

## Support

For support and questions:

- Open an issue on [GitHub](https://github.com/vahidkaargar/bamboo-card-portal/issues)
- Contact the maintainer at vahidkaargar@gmail.com
- Check the [documentation](https://github.com/vahidkaargar/bamboo-card-portal) for detailed examples