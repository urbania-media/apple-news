<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class TiktokHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return is_array($block) &&
            $block['tag'] === 'blockquote' &&
            isset($block['attributes']['class']) &&
            $block['attributes']['class'] === 'tiktok-embed' && isset($block['attributes']['cite']);
    }

    public function handle($block)
    {
        return [
            'role' => 'tiktok',
            'URL' => $block['attributes']['cite'],
        ];
    }
}
