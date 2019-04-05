<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class HeadingHandler extends TextHandler implements HtmlHandler
{
    protected $headingPattern = '/^h([2-6])$/i';

    public function canHandle($block)
    {
        return is_array($block) && preg_match($this->headingPattern, $block['tag']) === 1;
    }

    public function handle($block)
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
