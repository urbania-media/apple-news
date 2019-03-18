<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;

class Document
{
    protected $document;
    protected $url;

    public function __construct(DomDocument $document, string $url)
    {
        $this->document = $document;
        $this->url = $url;
    }

    public function getLinks()
    {
        $symbols = $this->document->find('#main a');
        $links = [];
        $baseUrl = preg_quote('/documentation/apple_news/', '/');
        foreach ($symbols as $symbol) {
            $href = $symbol->getAttribute('href');
            if (preg_match('/^'.$baseUrl.'((apple_news_format\/[^\/]+)|([^\/]+(\/([^\/]+))?))$/', $href) &&
                !preg_match('/^'.$baseUrl.'apple_news_api/', $href) &&
                !in_array($href, $links)
            ) {
                $links[] = $href;
            }
        }
        return array_map(function ($link) {
            return $this->getAbsoluteUrl($link);
        }, $links);
    }

    public function getObjectsLinks()
    {
        $symbols = $this->document->find('#main a');
        $links = [];
        foreach ($symbols as $symbol) {
            $href = $symbol->getAttribute('href');
            $info = $this->getSymbolLinkInfo($symbol);
            if (is_null($info) || $info['decorator'] !== 'object') {
                continue;
            }
            $links[$info['identifier']] = $this->getAbsoluteUrl($href);
        }
        return $links;
    }

    protected function getSymbolLinkInfo($link)
    {
        $children = $link->children();
        if (sizeof($children) === 0 || $children[0]->tag !== 'code') {
            return null;
        }
        $code = $children[0];
        $children = $code->children();
        if (sizeof($children) !== 2 ||
            !$children[0]->classes()->contains('decorator') ||
            !$children[1]->classes()->contains('identifier')
        ) {
            return null;
        }
        return [
            'decorator' => $this->trim($children[0]->text()),
            'identifier' => $this->trim($children[1]->text())
        ];
    }

    protected function getAbsoluteUrl($url)
    {
        return preg_match('/^https?:\/\//', $url) === 0
            ? 'https://developer.apple.com' . $url
            : $url;
    }

    protected function trim($text)
    {
        return trim(preg_replace('/^[\s\t\n]+(.*?)[\s\t\n]+$/', '$1', $text));
    }
}
