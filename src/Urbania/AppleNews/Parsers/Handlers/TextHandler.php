<?php

namespace Urbania\AppleNews\Parsers\Handlers;

use Urbania\AppleNews\Contracts\HtmlHandler;
use DiDom\Element;
use DOMText;

abstract class TextHandler implements HtmlHandler
{
    protected $addClassAsInlineStyle = false;

    public function __construct($opts = [])
    {
        $this->setOptions($opts);
    }

    public function setOptions(array $opts)
    {
        if (isset($opts['addClassAsInlineStyle'])) {
            $this->addClassAsInlineStyle = $opts['addClassAsInlineStyle'];
        }
    }

    protected function getBlockAsHtml($block, $removeWrapper = false)
    {
        $element = $this->getBlockElement($block);
        $html = $element->html();
        return $removeWrapper ? $this->removeWrapper($html) : $html;
    }

    protected function getBlockAsText($block)
    {
        $element = $this->getBlockElement($block);
        return $element->text();
    }

    protected function removeWrapper($html)
    {
        return $this->trimText(
            preg_replace('/^(<[^>]+>)?(.*?)(<\/[^>]+>)?$/si', '$2', $html)
        );
    }

    protected function getBlockElement($block)
    {
        if (is_string($block)) {
            return new Element(new DOMText($block));
        }

        $attributes = array_merge(
            $block['attributes'],
            $this->addClassAsInlineStyle && sizeof($block['class'])
                ? [
                    'data-anf-textstyle' => implode('-', $block['class'])
                ]
                : []
        );

        $element = new Element($block['tag'], null, $attributes);
        if (isset($block['text'])) {
            $element->setValue(htmlspecialchars($block['text']));
        }
        if (isset($block['blocks'])) {
            $childElements = array_map(function ($childBlock) {
                return $this->getBlockElement($childBlock);
            }, $block['blocks']);
            foreach ($childElements as $childElement) {
                $element->appendChild($childElement);
            }
        }
        return $element;
    }
}
