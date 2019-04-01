<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class ListHandler extends TextHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return is_array($block) && $block['tag'] === 'ul';
    }

    public function handle($block)
    {
        return [
            'role' => 'body',
            'format' => 'html',
            'text' => $this->getBlockAsHtml($block)
        ];
    }
}
