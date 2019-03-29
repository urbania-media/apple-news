<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesHeading
{
    protected $headingPattern = '/^h([2-6])$/i';

    protected function isBlockHeading($block)
    {
        return preg_match($this->headingPattern, $block['tag']) === 1;
    }

    protected function getComponentFromHeadingBlock($block)
    {
        preg_match($this->headingPattern, $block['tag'], $matches);
        return isset($block['text'])
            ? [
                'role' => 'heading' . $matches[1],
                'text' => $this->removeWrapper($block['text'])
            ]
            : [
                'role' => 'heading' . $matches[1],
                'format' => 'html',
                'text' => $this->getBlockAsHtml($block, true)
            ];
    }
}
