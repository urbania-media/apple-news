<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class TitleHandler extends TextHandler implements HtmlHandler
{
    protected $titlePattern = '/^h1/i';

    public function canHandle($block)
    {
        return preg_match($this->titlePattern, $block['tag']) === 1;
    }

    public function handle($block)
    {
        return isset($block['text'])
            ? [
                'role' => 'title',
                'text' => $this->removeWrapper($block['text'])
            ]
            : [
                'role' => 'title',
                'format' => 'html',
                'text' => $this->getBlockAsHtml($block, true)
            ];
    }
}
