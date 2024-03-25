<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class EmbedHandler implements HtmlHandler
{
    protected $embedPattern = '/(youtube\.com|vimeo\.com|dailymotion\.com)/i';

    public function canHandle($block)
    {
        return is_array($block) &&
            $block['tag'] === 'iframe' &&
            isset($block['attributes']['src']) &&
            preg_match($this->embedPattern, $block['attributes']['src']) === 1;
    }

    public function handle($block)
    {
        return [
            'role' => 'embedwebvideo',
            'URL' => $this->getEmbedUrl($block),
        ];
    }

    protected function getEmbedUrl($block)
    {
        $url = parse_url($block['attributes']['src']);
        $url = sprintf(
            '%s//%s%s',
            isset($url['scheme']) ? $url['scheme'] . ':' : 'https:',
            $url['host'],
            $url['path']
        );
        if (preg_match('/youtube\.com\/shorts\/([^/]+)$/', $url, $matches) === 1) {
            $url = 'https://youtube.com/watch?v=' . $matches[1];
        }
        return $url;
    }
}
