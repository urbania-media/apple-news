<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class InstagramHandler implements HtmlHandler
{
    public function canHandle($block)
    {
        return is_array($block) &&
            $block['tag'] === 'blockquote' &&
            isset($block['attributes']['class']) &&
            $block['attributes']['class'] === 'instagram-media' && isset($block['attributes']['data-instgrm-permalink']);
    }

    public function handle($block)
    {
        return [
            'role' => 'tiktok',
            'URL' => $block['attributes']['data-instgrm-permalink'],
        ];
    }
}
