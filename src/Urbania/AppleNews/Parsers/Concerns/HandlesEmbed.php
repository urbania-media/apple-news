<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesEmbed
{
    protected $embedPattern = '/(youtube\.com|vimeo\.com)/i';

    protected function isBlockEmbed($block)
    {
        return $block['tag'] === 'iframe' &&
            isset($block['attributes']['src']) &&
            preg_match($this->embedPattern, $block['attributes']['src']) === 1;
    }

    protected function getComponentFromEmbedBlock($block)
    {
        return [
            'role' => 'embedwebvideo',
            'URL' => $block['attributes']['src']
        ];
    }
}
