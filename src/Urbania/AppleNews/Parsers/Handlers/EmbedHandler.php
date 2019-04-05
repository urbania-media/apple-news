<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class EmbedHandler implements HtmlHandler
{
    protected $embedPattern = '/(youtube\.com|vimeo\.com)/i';

    public function canHandle($block)
    {
        return is_array($block) && $block['tag'] === 'iframe' &&
            isset($block['attributes']['src']) &&
            preg_match($this->embedPattern, $block['attributes']['src']) === 1;
    }

    public function handle($block)
    {
        $url = parse_url($block['attributes']['src']);
        return [
            'role' => 'embedwebvideo',
            'URL' => sprintf('%s://%s%s', $url['scheme'], $url['host'], $url['path'])
        ];
    }
}
