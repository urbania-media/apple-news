<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesImage
{
    protected function isBlockImage($block)
    {
        return $block['tag'] === 'img';
    }

    protected function getComponentFromImageBlock($block)
    {
        return [
            'role' => 'photo',
            'URL' => $block['attributes']['src']
        ];
    }
}
