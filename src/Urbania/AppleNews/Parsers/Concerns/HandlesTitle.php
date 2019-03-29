<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesTitle
{
    protected $titlePattern = '/^h1/i';

    protected function isBlockTitle($block)
    {
        return preg_match($this->titlePattern, $block['tag']) === 1;
    }

    protected function getComponentFromTitleBlock($block)
    {
        return isset($block['text'])
            ? [
                'role' => 'title',
                'text' => $this->removeWrapper($block['text'])
            ]
            : [
                'role' => 'title',
                'format' => 'html',
                'text' => $this->getBlockAsHtml($block, true)
            ];
    }
}
