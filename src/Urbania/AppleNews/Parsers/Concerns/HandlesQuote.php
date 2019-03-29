<?php

namespace Urbania\AppleNews\Parsers\Concerns;

trait HandlesQuote
{
    protected $quotePattern = '/^blockquote$/i';

    protected function isBlockQuote($block)
    {
        return preg_match($this->quotePattern, $block['tag']) === 1;
    }

    protected function getComponentFromQuoteBlock($block)
    {
        return [
            'role' => 'quote',
            'format' => 'html',
            'text' => $this->getBlockAsText($block)
        ];
    }
}
