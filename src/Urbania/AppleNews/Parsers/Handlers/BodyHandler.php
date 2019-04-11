<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class BodyHandler extends TextHandler implements HtmlHandler
{
    protected $tagPattern = '/^(p|div|section|article)$/i';
    protected $inlinePattern = '/^(a|strong|em|span|b|i)$/i';

    public function canHandle($block)
    {
        return is_string($block) ||
            preg_match($this->tagPattern, $block['tag']) === 1 ||
            preg_match($this->inlinePattern, $block['tag']) === 1;
    }

    public function handle($block)
    {
        if (is_array($block) && !isset($block['text'])) {
            return [
                'role' => 'body',
                'format' => 'html',
                'text' => $this->getBlockAsHtml($block)
            ];
        }

        return [
            'role' => 'body',
            'text' => is_string($block) ? $block : $block['text']
        ];
    }
}
