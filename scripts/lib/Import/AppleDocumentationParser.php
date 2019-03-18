<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;
use Webmozart\Assert\Assert;

class AppleDocumentationParser
{
    const APPLE_NEWS_FORMAT = 'APPLE_NEWS_FORMAT';
    const APPLE_NEWS_API = 'APPLE_NEWS_API';

    protected $sdk = self::APPLE_NEWS_FORMAT;

    protected $patterns = [
        self::APPLE_NEWS_FORMAT => '/Apple News Format/',
        self::APPLE_NEWS_API => '/Apple News API/'
    ];

    public function __construct($sdk = null)
    {
        if (!is_null($sdk)) {
            Assert::oneOf($sdk, [
                static::APPLE_NEWS_FORMAT,
                static::APPLE_NEWS_API
            ]);
            $this->sdk = $sdk;
        }
    }

    public function parse($html, $url)
    {
        $document = new DomDocument($html);

        if ($this->isObject($document)) {
            if ($this->sdk === static::APPLE_NEWS_API) {
                return new ApiObjectDocument($document, $url);
            } else {
                return new ObjectDocument($document, $url);
            }
        }

        return new Document($document, $url);
    }

    protected function isObject(DomDocument $document)
    {
        return $this->eyebrowIsObject($document) &&
            $this->titleIsObject($document) &&
            $this->isFromSdk($document);
    }

    protected function eyebrowIsObject(DomDocument $document)
    {
        $eyebrowSelector = '#main .topic-title .eyebrow';
        return $document->has($eyebrowSelector) &&
            strtolower(trim($document->find($eyebrowSelector)[0]->text())) ===
                'object';
    }

    protected function titleIsObject(DomDocument $document)
    {
        $titleSelector = '#main .topic-title .topic-heading';
        return $document->has($titleSelector) &&
            preg_match(
                '/\s/',
                trim($document->find($titleSelector)[0]->text())
            ) === 0;
    }

    protected function isFromSdk(DomDocument $document)
    {
        $pattern = $this->patterns[$this->sdk];
        $technologySelector = '#main .topic-summary .sdks';
        return $document->has($technologySelector) &&
            preg_match(
                $pattern,
                $document->find($technologySelector)[0]->text()
            );
    }
}
