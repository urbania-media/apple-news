<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class EmbedHandler implements HtmlHandler
{
    protected $embedPattern = '/(youtube\.com|vimeo\.com)/i';

    public function canHandle($block)
    {
        return $block['tag'] === 'iframe' &&
            isset($block['attributes']['src']) &&
            preg_match($this->embedPattern, $block['attributes']['src']) === 1;
    }

    public function handle($block)
    {
        return [
            'role' => 'embedwebvideo',
            'URL' => $block['attributes']['src']
        ];
    }
}
