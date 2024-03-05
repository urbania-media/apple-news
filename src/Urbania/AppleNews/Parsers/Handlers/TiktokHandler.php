<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class TiktokHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return is_array($block) &&
            $block['tag'] === 'blockquote' &&
            isset($block['class']) &&
            in_array('tiktok-embed', $block['class']) &&
            isset($block['attributes']['cite']);
    }

    public function handle($block)
    {
        return [
            'role' => 'tiktok',
            'URL' => $block['attributes']['cite'],
        ];
    }
}
