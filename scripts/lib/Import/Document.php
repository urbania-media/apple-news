<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;

class Document
{
    protected $data;
    protected $url;

    public function __construct($data, string $url)
    {
        $this->data = $data;
        $this->url = $url;
    }

    public function getLinks()
    {
        return collect(data_get($this->data, 'references', []))
            ->filter(function ($item) {
                return isset($item['url']) &&
                    !empty($item['url']) &&
                    preg_match('/^\/documentation\/apple_news/', $item['url']) !== 0 &&
                    preg_match('/apple_news_format_tutorials/', $item['url']) === 0 &&
                    preg_match('/\.([a-z]{2,4})$/', $item['url']) === 0;
            })
            ->map(function ($item) {
                return $this->getAbsoluteUrl($item['url']);
            })
            ->values()
            ->toArray();
    }

    public function getObjectsLinks()
    {
        return collect(data_get($this->data, 'references', []))
            ->values()
            ->filter(function ($item) {
                return $item['role'] === 'collectionSymbol';
            })
            ->mapWithKeys(function ($item) {
                return [
                    $item['title'] => $this->getAbsoluteUrl($item['url']),
                ];
            });
    }

    protected function getAbsoluteUrl($url)
    {
        return 'https://developer.apple.com/tutorials/data/' .
            explode('#', trim($url, '/'))[0] .
            '.json';
    }

    protected function trim($text)
    {
        return trim(preg_replace('/^[\s\t\n]+(.*?)[\s\t\n]+$/', '$1', $text));
    }
}
