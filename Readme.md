Apple News PHP
============
This package offer a wrapper around the Apple News API and Apple News Format in PHP. It includes support for Laravel, Wordpress and an HTML parser.

- [Installation](#Installation)
    - [Laravel](#Laravel)
- [Usage](#Usage)

## Installation
```bash
composer require urbania/apple-news
```

### Laravel

#### Versions prior to 5.5
1. Add the Service Provider in the config file `config/app.php`:

```php
'providers' => [
    // ...
    \Urbania\AppleNews\Laravel\AppleNewsServiceProvider::class,
    // ...
]
```

2. Add the Facade in the config file `config/app.php`:

```php
'facades' => [
    // ...
    'AppleNews' => \Urbania\AppleNews\Laravel\AppleNewsFacade::class,
    // ...
]
```

#### All versions

Publish the config file:
```bash
php artisan vendor:publish
```

## Usage
