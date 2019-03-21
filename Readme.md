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

Publish the config file to `config/apple-news.php`:
```bash
php artisan vendor:publish
```

## Usage

### Pure PHP

Create a test article:
```php

require __DIR__ . '/vendor/autoload.php';

use Urbania\AppleNews\Article;

$article = new Article([
    'identifier' => 'test-article',
    'language' => 'en-US',
    'version' => '1.7',
    'layout' => [
        'columns' => 12,
        'width' => 1024
    ],
    'title' => 'An article',
    'components' => [
        [
            'role' => 'title',
            'text' => 'This is a title'
        ],
        [
            'role' => 'body',
            'text' => 'This is a body'
        ]
    ]
]);

echo $article->toJson();

```

### Laravel

Create a test article:
```php

// Using the facade
use AppleNews;

$article = AppleNews::article([
    'identifier' => 'test-article',
    'language' => 'en-US',
    'version' => '1.7',
    'layout' => [
        'columns' => 12,
        'width' => 1024
    ],
    'title' => 'An article',
    'components' => [
        [
            'role' => 'title',
            'text' => 'This is a title'
        ],
        [
            'role' => 'body',
            'text' => 'This is a body'
        ]
    ]
]);

// Using the helper
$article = article([
    // ... same as above
]);

echo $article->toJson();

```
