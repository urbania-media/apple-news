<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class GiphyHandler implements HtmlHandler
{
    protected $giphyPattern = '/https\:\/\/giphy.com\/embed\/([^\/]+)/i';

    public function canHandle($block)
    {
        return is_array($block) && $block['tag'] === 'iframe' && isset($block['attributes']['src']) &&
            preg_match($this->giphyPattern, $block['attributes']['src']) === 1;
    }

    public function handle($block)
    {
        $url = $this->getGiphyUrl($block);
        return [
            'role' => 'photo',
            'URL' => $url
        ];
    }

    protected function getGiphyUrl($block)
    {
        preg_match($this->giphyPattern, $block['attributes']['src'], $matches);
        return sprintf('https://media.giphy.com/media/%s/giphy.gif', $matches[1]);
    }
}
