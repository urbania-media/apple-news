<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;
use Illuminate\Support\Arr;
use Webmozart\Assert\Assert;

class AppleDocumentationParser
{
    const APPLE_NEWS_FORMAT = 'Apple News Format';
    const APPLE_NEWS_API = 'Apple News API';

    protected $sdk = self::APPLE_NEWS_FORMAT;

    public function __construct($sdk = null)
    {
        if (!is_null($sdk)) {
            Assert::oneOf($sdk, [static::APPLE_NEWS_FORMAT, static::APPLE_NEWS_API]);
            $this->sdk = $sdk;
        }
    }

    public function parse($data, $url)
    {
        if ($this->isObject($data)) {
            if ($this->sdk === static::APPLE_NEWS_API) {
                return new ApiObjectDocument($data, $url);
            } else {
                return new ObjectDocument($data, $url);
            }
        }

        return new Document($data, $url);
    }

    protected function isObject($data)
    {
        $role = data_get($data, 'metadata.roleHeading');
        return $role === 'Object' && $this->isFromSdk($data);
    }

    protected function isFromSdk($data)
    {
        return collect(data_get($data, 'metadata.modules', []))->contains(function ($module) {
            return $module['name'] === $this->sdk;
        });
    }
}
