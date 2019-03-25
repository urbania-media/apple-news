<?php

namespace Urbania\AppleNews\Parsers;

use DiDom\Document;
use DiDom\Element;
use DOMText;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Support\Parser;

class HtmlParser extends Parser
{
    protected $article = [];

    protected $addClassAsInlineStyle = true;

    protected $moveUpContainers = [
        [
            'tag' => 'div',
            'class' => 'articleTitle'
        ],
        [
            'tag' => 'div',
            'class' => 'articleContent'
        ]
    ];

    public function __construct($opts = [])
    {
        $this->setOptions($opts);
    }

    public function setOptions(array $opts)
    {
        if (isset($opts['article'])) {
            $this->article = $opts['article'];
        }

        if (isset($opts['addClassAsInlineStyle'])) {
            $this->addClassAsInlineStyle = $opts['addClassAsInlineStyle'];
        }

        if (isset($opts['moveUpContainers'])) {
            $this->moveUpContainers = $opts['moveUpContainers'];
        }
    }

    public function parse($html, $article = null)
    {
        $document = new Document($html);
        $bodyElements = $document->find('body');
        $titleElements = $document->find('title');
        $body = sizeof($bodyElements) ? $bodyElements[0] : null;
        $title = sizeof($titleElements) ? $titleElements[0] : null;
        if (!is_null($body)) {
            $innerNode = $this->getInnerNode($body);
            $blocks = $this->getBlocks($innerNode);
            $components = $this->getComponentsFromBlocks($blocks);
        } else {
            $components = [
                [
                    'role' => 'body',
                    'text' => $html
                ]
            ];
        }

        $data = [
            'components' => $components
        ];
        if (!is_null($title)) {
            $data['title'] = $title->text();
        }

        $parsedArticle = new Article($this->article);
        if (!is_null($article)) {
            $parsedArticle->merge($article);
        }
        $parsedArticle->merge($data);

        return $parsedArticle;
    }

    protected function getComponentsFromBlocks($blocks, $components = [])
    {
        foreach ($blocks as $block) {
            if (is_string($block)) {
                $components[] = [
                    'role' => 'body',
                    'text' => $block
                ];
            } elseif ($block['tag'] === 'p') {
                $components[] = [
                    'role' => 'body',
                    'format' => 'html',
                    'text' => $this->getBlockAsHtml($block)
                ];
            } elseif ($this->isTitle($block['tag'])) {
                $components[] = isset($block['text'])
                    ? [
                        'role' => 'title',
                        'text' => $this->removeWrapper($block['text'])
                    ]
                    : [
                        'role' => 'title',
                        'format' => 'html',
                        'text' => $this->getBlockAsHtml($block, true)
                    ];
            } elseif ($heading = $this->isHeading($block['tag'])) {
                $components[] = isset($block['text'])
                    ? [
                        'role' => 'heading' . $heading,
                        'text' => $this->removeWrapper($block['text'])
                    ]
                    : [
                        'role' => 'heading' . $heading,
                        'format' => 'html',
                        'text' => $this->getBlockAsHtml($block, true)
                    ];
            } elseif ($this->isEmbed($block)) {
                $components[] = [
                    'role' => 'embedwebvideo',
                    'URL' => $block['attributes']['src']
                ];
            }
        }

        return $components;
    }

    protected function getBlockAsHtml($block, $removeWrapper = false)
    {
        $element = $this->getBlockElement($block);
        $html = $element->html();
        return $removeWrapper ? $this->removeWrapper($html) : $html;
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

    public function getInnerNode($node)
    {
        $children = $node->children();
        $notEmptyChildren = [];
        foreach ($children as $child) {
            if (!$this->isNodeEmpty($child)) {
                $notEmptyChildren[] = $child;
            }
        }
        return sizeof($notEmptyChildren) === 1
            ? $this->getInnerNode($notEmptyChildren[0])
            : $node;
    }

    public function allChildrenAreTextNodes($node)
    {
        $children = $node->children();
        return array_reduce(
            $children,
            function ($textNode, $child) {
                return $textNode && $child->isTextNode();
            },
            true
        );
    }

    protected function isNodeEmpty($node)
    {
        $text = $this->trimText($node->text());
        return empty($text);
    }

    protected function isEmbed($block)
    {
        return $block['tag'] === 'iframe' &&
            preg_match(
                '/(youtube\.com|vimeo\.com)/i',
                $block['attributes']['src']
            ) === 1;
    }

    protected function containsIframe($node)
    {
        $html = $node->html();
        return preg_match('/<(amp-)iframe[^>]*><\/(amp-)iframe[^>]*>/i', $html);
    }

    protected function isIframe($node)
    {
        return preg_match('/^(amp-)iframe$/i', $node->tag);
    }

    public function getBlocks($node)
    {
        $blocks = [];
        $children = $node->children();
        $lastWasInline = false;
        foreach ($children as $child) {
            $nodeIsEmpty = $this->isNodeEmpty($child);
            $containsIframe = $this->containsIframe($child);
            if (!$lastWasInline && $nodeIsEmpty && !$containsIframe) {
                continue;
            }

            if ($child->isTextNode()) {
                $blocks[] = $child->text();
                $lastWasInline = true;
                continue;
            }

            $isIframe = $this->isIframe($child);
            $classes = $child->classes()->getAll();
            sort($classes);
            $block = [
                'tag' => $isIframe ? 'iframe' : $child->tag,
                'class' => $classes,
                'attributes' => []
            ];

            if ($block['tag'] === 'a') {
                $block['attributes']['href'] = (string) $child->getAttribute(
                    'href'
                );
            } elseif ($isIframe) {
                $block['attributes']['src'] = (string) $child->getAttribute(
                    'src'
                );
            }

            $lastWasInline = $this->isInline($child->tag);

            $text = null;
            $childBlocks = null;
            if ($this->allChildrenAreTextNodes($child)) {
                $text = $child->text();
            } else {
                $childBlocks = $this->getBlocks($child);
            }

            if ($this->isMoveUpContainer($block)) {
                if (!is_null($text)) {
                    $blocks[] = $text;
                } else {
                    $blocks = array_merge($blocks, $childBlocks);
                }
                continue;
            }

            if ($nodeIsEmpty && $containsIframe && !$isIframe) {
                $blocks = array_merge($blocks, $childBlocks);
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
        return preg_match('/^h([2-6])$/', $tag, $matches) === 1
            ? (int) $matches[1]
            : false;
    }

    protected function isTitle($tag)
    {
        return preg_match('/^h1$/', $tag) === 1;
    }

    protected function isMoveUpContainer($block)
    {
        return array_reduce(
            $this->moveUpContainers,
            function ($ignore, $container) use ($block) {
                return $ignore || $this->isBlockEquals($container, $block);
            },
            false
        );
    }

    protected function isBlockEquals($a, $b)
    {
        if (is_string($a) || is_string($b)) {
            return $a === $b;
        }
        $aClass = (array) $a['class'];
        $bClass = (array) $b['class'];
        return $a['tag'] === $b['tag'] &&
            sizeof(array_diff($aClass, $bClass)) === 0;
    }

    protected function trimText($text)
    {
        return preg_replace('/^[\s\n\t]*(.*?)[\s\n\t]*$/us', '$1', $text);
    }
}
