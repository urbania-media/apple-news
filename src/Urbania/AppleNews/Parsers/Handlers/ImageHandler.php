<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class ImageHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return $block['tag'] === 'img';
    }

    public function handle($block)
    {
        return [
            'role' => 'photo',
            'URL' => $block['attributes']['src']
        ];
    }
}
