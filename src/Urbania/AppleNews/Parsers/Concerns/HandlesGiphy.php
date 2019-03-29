<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesGiphy
{
    protected $giphyPattern = '/https\:\/\/giphy.com\/embed\/([^\/]+)/i';

    protected function isBlockGiphy($block)
    {
        return $block['tag'] === 'iframe' && isset($block['attributes']['src']) &&
            preg_match($this->giphyPattern, $block['attributes']['src']) === 1;
    }

    protected function getGiphyUrl($block)
    {
        preg_match($this->giphyPattern, $block['attributes']['src'], $matches);
        return sprintf('https://media.giphy.com/media/%s/giphy.gif', $matches[1]);
    }

    protected function getComponentFromGiphyBlock($block)
    {
        $url = $this->getGiphyUrl($block);
        return [
            'role' => 'photo',
            'URL' => $url
        ];
    }
}
