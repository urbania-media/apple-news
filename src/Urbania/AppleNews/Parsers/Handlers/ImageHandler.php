<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class ImageHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return is_array($block) && $block['tag'] === 'img';
    }

    public function handle($block)
    {
        return [
            'role' => 'photo',
            'URL' => preg_replace('/-(scaled|([0-9]+x[0-9]+))\.(gif|jpg|png|jpeg)/i', '.$3', $block['attributes']['src'])
        ];
    }
}
