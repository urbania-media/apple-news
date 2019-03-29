<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesBody
{
    protected $bodyPattern = '/^p/i';

    protected function isBlockBody($block)
    {
        return is_string($block) || preg_match($this->bodyPattern, $block['tag']) === 1;
    }

    protected function getComponentFromBodyBlock($block)
    {
        if (is_string($block)) {
            return [
                'role' => 'body',
                'text' => $block
            ];
        } elseif ($block['tag'] === 'p') {
            return [
                'role' => 'body',
                'format' => 'html',
                'text' => $this->getBlockAsHtml($block)
            ];
        }
    }
}
