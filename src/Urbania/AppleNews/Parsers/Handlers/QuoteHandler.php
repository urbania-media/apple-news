<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class QuoteHandler extends TextHandler implements HtmlHandler
{
    protected $quotePattern = '/^blockquote$/i';

    public function canHandle($block)
    {
        return is_array($block) && preg_match($this->quotePattern, $block['tag']) === 1;
    }

    public function handle($block)
    {
        return [
            'role' => 'quote',
            'format' => 'html',
            'text' => $this->getBlockAsText($block)
        ];
    }
}
