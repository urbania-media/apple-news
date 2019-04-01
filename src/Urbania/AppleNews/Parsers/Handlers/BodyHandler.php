<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;

class BodyHandler extends TextHandler implements HtmlHandler
{
    protected $inlinePattern = '/^(a|strong|em|span)$/i';

    public function canHandle($block)
    {
        return is_string($block) ||
            $block['tag'] === 'p' ||
            isset($block['text']) && !empty($block['text']);
    }

    public function handle($block)
    {
        if ($block['tag'] === 'p') {
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
