<?php

namespace Urbania\AppleNews\Parsers;

use DiDom\Document;
use DiDom\Element;
use DOMText;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Support\Parser;

class HtmlParser extends Parser
{
    protected $options = [
        'ignoreContainers' => [
            [
                'tag' => 'div',
                'class' => 'articleTitle'
            ],
            [
                'tag' => 'div',
                'class' => 'articleContent'
            ]
        ]
    ];

    protected $articleDefaults = [
        // 'componentLayouts' => [
        //     'paragraph' => [
        //         'contentInset' => [
        //             'bottom' => true
        //         ]
        //     ]
        // ]
    ];

    public function __construct($opts = [], $defaults = [])
    {
        $this->options = array_merge($this->options, $opts);
        $this->articleDefaults = array_merge($this->articleDefaults, $defaults);
    }

    public function parse($html, $defaults = [])
    {
        $document = new Document($html);
        $body = $document->find('body')[0] ?? null;
        $title = $document->find('title')[0] ?? null;
        if (!is_null($body)) {
            $innerNode = $this->getInnerNode($body);
            $blocks = $this->getBlocks($innerNode);
            $components = $this->getComponentsFromBlocks($blocks);
        } else {
            $components = [
                [
                    'role' => 'body',
                    'text' => $html,
                ]
            ];
        }

        $data = [
            'components' => $components
        ];
        if (!is_null($title)) {
            $data['title'] = $title->text();
        }

        return new Article(array_merge($this->articleDefaults, $defaults, $data));
    }

    protected function getComponentsFromBlocks($blocks, $components = [])
    {
        foreach ($blocks as $block) {
            if (is_string($block)) {
                $components[] = [
                    'role' => 'body',
                    'text' => $block,
                ];
            } elseif ($block['tag'] === 'p') {
                $components[] = [
                    'role' => 'body',
                    'format' => 'html',
                    'text' => $this->getBlockAsHtml($block),
                    'layout' => 'paragraph'
                ];
            } elseif ($this->isHeading($block['tag'])) {
                $components[] = isset($block['text']) ? [
                    'role' => 'title',
                    'text' => $block['text'],
                ] : [
                    'role' => 'title',
                    'format' => 'html',
                    'text' => $this->getBlockAsHtml($block),
                ];
            }
        }

        return $components;
    }

    protected function getBlockAsHtml($block)
    {
        $element = $this->getBlockElement($block);
        return $element->html();
    }

    protected function getBlockElement($block)
    {
        if (is_string($block)) {
            return new Element(new DOMText($block));
        }

        $attributes = array_merge($block['attributes'], sizeof($block['class']) ? [
            'data-anf-textstyle' => implode('-', $block['class']),
        ] : []);

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

    public function getInnerNode($node)
    {
        $children = $node->children();
        $notEmptyChildren = [];
        foreach ($children as $child) {
            if (!$this->isNodeEmpty($child)) {
                $notEmptyChildren[] = $child;
            }
        }
        return sizeof($notEmptyChildren) === 1 ? $this->getInnerNode($notEmptyChildren[0]) : $node;
    }

    public function allChildrenAreTextNodes($node)
    {
        $children = $node->children();
        return array_reduce($children, function ($textNode, $child) {
            return $textNode && $child->isTextNode();
        }, true);
    }

    protected function isNodeEmpty($node)
    {
        $text = $this->trimText($node->text());
        return empty($text);
    }

    public function getBlocks($node)
    {
        $blocks = [];
        $children = $node->children();
        $lastWasInline = false;
        foreach ($children as $child) {
            if (!$lastWasInline && $this->isNodeEmpty($child)) {
                continue;
            }

            if ($child->isTextNode()) {
                $blocks[] = $child->text();
                $lastWasInline= true;
                continue;
            }

            $classes = $child->classes()->getAll();
            sort($classes);
            $block = [
                'tag' => $child->tag,
                'class' => $classes,
                'attributes' => []
            ];

            if ($block['tag'] === 'a') {
                $block['attributes']['href'] = (string)$child->getAttribute('href');
            }

            $lastWasInline = $this->isInline($child->tag);

            $text = null;
            $childBlocks = null;
            if ($this->allChildrenAreTextNodes($child)) {
                $text = $child->text();
            } else {
                $childBlocks = $this->getBlocks($child);
            }

            if ($this->isIgnoredContainers($block)) {
                if (!is_null($text)) {
                    $blocks[] = $text;
                } else {
                    $blocks = array_merge($blocks, $childBlocks);
                }
                continue;
            }

            if (!is_null($text)) {
                $block['text'] = $text;
            } else {
                $block['blocks'] = $childBlocks;
            }

            $blocks[] = $block;
        }

        return $blocks;
    }

    protected function isInline($tag)
    {
        return in_array($tag, ['span', 'strong', 'b', 'em', 'a']);
    }

    protected function isHeading($tag)
    {
        return preg_match('/^h[1-6]$/', $tag) === 1;
    }

    protected function isIgnoredContainers($block)
    {
        $ignoreContainers = $this->options['ignoreContainers'] ?? [];
        return array_reduce($ignoreContainers, function ($ignore, $container) use ($block) {
            return $ignore || $this->isBlockEquals($container, $block);
        }, false);
    }

    protected function isBlockEquals($a, $b)
    {
        if (is_string($a) || is_string($b)) {
            return $a === $b;
        }
        $aClass = (array)$a['class'];
        $bClass = (array)$b['class'];
        return $a['tag'] === $b['tag'] && sizeof(array_diff($aClass, $bClass)) === 0;
    }

    protected function trimText($text)
    {
        return preg_replace('/^[\s\n\t]*(.*?)[\s\n\t]*$/us', '$1', $text);
    }
}
