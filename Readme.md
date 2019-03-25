Apple News PHP
============
This package offer a wrapper around the Apple News API and Apple News Format in PHP. It includes support for Laravel, Wordpress and an HTML parser.

[![Packagist](https://img.shields.io/packagist/v/urbania/apple-news.svg)](https://packagist.org/packages/urbania/apple-news)
[![Travis (.org) branch](https://img.shields.io/travis/urbania-media/apple-news/master.svg)](https://travis-ci.org/urbania-media/apple-news)
[![Coveralls github](https://img.shields.io/coveralls/github/urbania-media/apple-news.svg)](https://coveralls.io/github/urbania-media/apple-news)

- [Installation](#installation)
    - [Laravel](#laravel)
- [Usage](#usage)
    - [Pure PHP](#pure-php)
    - [Laravel](#laravel-1)

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

Create a test article: (when creating an article with the facade or the helper, it takes into account the default `article` values found in `config/apple-news.php`)
```php

// Using the facade
use AppleNews;

$article = AppleNews::article([
    'identifier' => 'test-article',
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
