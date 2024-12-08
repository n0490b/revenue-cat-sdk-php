# RevenueCat PHP SDK

A modern PHP SDK for the RevenueCat API, following SOLID principles and PSR standards.

## Installation

You can install the package via composer:

```bash
composer require lanos/revenuecat-sdk-php
```

## Usage

### Basic Setup

```php
use Lanos\RevenueCat\Config\Configuration;
use Lanos\RevenueCat\RevenueCatClient;

// Create a configuration instance
$config = new Configuration('your-api-key');

// Create the RevenueCat client
$client = new RevenueCatClient($config);
```

### Working with Customers

```php
// Get a customer
$customer = $client->customers()->get('project-id', 'customer-id');

// List customers
$customers = $client->customers()->list('project-id', [
    'limit' => 10,
    'starting_after' => 'last-customer-id'
]);

// Create a customer
$customer = $client->customers()->create('project-id', [
    'id' => 'customer-id',
    'attributes' => [
        ['name' => '$email', 'value' => 'customer@example.com']
    ]
]);

// Get customer's active entitlements
$entitlements = $client->customers()->getActiveEntitlements('project-id', 'customer-id');
```

### Working with Entitlements

```php
// Get an entitlement
$entitlement = $client->entitlements()->get('project-id', 'entitlement-id');

// List entitlements
$entitlements = $client->entitlements()->list('project-id');

// Create an entitlement
$entitlement = $client->entitlements()->create('project-id', [
    'lookup_key' => 'premium',
    'display_name' => 'Premium Access'
]);

// Attach products to an entitlement
$client->entitlements()->attachProducts('project-id', 'entitlement-id', [
    'product_ids' => ['product-1', 'product-2']
]);
```

### Working with Products

```php
// Get a product
$product = $client->products()->get('project-id', 'product-id');

// List products
$products = $client->products()->list('project-id', [
    'app_id' => 'app-id'
]);

// Create a product
$product = $client->products()->create('project-id', [
    'store_identifier' => 'com.example.product',
    'type' => 'subscription',
    'app_id' => 'app-id'
]);
```

### Working with Offerings

```php
// Get an offering
$offering = $client->offerings()->get('project-id', 'offering-id');

// List offerings
$offerings = $client->offerings()->list('project-id');

// Create an offering
$offering = $client->offerings()->create('project-id', [
    'lookup_key' => 'default',
    'display_name' => 'Standard Offering'
]);
```

### Working with Packages

```php
// Get a package
$package = $client->packages()->get('project-id', 'package-id');

// Update a package
$package = $client->packages()->update('project-id', 'package-id', [
    'display_name' => 'New Package Name'
]);

// Attach products to a package
$client->packages()->attachProducts('project-id', 'package-id', [
    'products' => [
        [
            'product_id' => 'product-id',
            'eligibility_criteria' => 'all'
        ]
    ]
]);
```

## Error Handling

The SDK throws specific exceptions for different types of errors:

```php
use Lanos\RevenueCat\Exceptions\AuthenticationException;
use Lanos\RevenueCat\Exceptions\AuthorizationException;
use Lanos\RevenueCat\Exceptions\NotFoundException;
use Lanos\RevenueCat\Exceptions\ValidationException;
use Lanos\RevenueCat\Exceptions\RateLimitException;
use Lanos\RevenueCat\Exceptions\ServerException;

try {
    $client->customers()->get('project-id', 'customer-id');
} catch (AuthenticationException $e) {
    // Handle invalid API key
} catch (AuthorizationException $e) {
    // Handle permission issues
} catch (NotFoundException $e) {
    // Handle resource not found
} catch (ValidationException $e) {
    // Handle validation errors
} catch (RateLimitException $e) {
    // Handle rate limiting
    $backoffMs = $e->getBackoffMs();
} catch (ServerException $e) {
    // Handle server errors
}
```

## Configuration Options

You can customize the client configuration:

```php
$config = new Configuration(
    apiKey: 'your-api-key',
    timeout: 30, // Request timeout in seconds
    headers: [
        'Custom-Header' => 'Value'
    ]
);
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
