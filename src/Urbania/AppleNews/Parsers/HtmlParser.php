<?php

namespace Urbania\AppleNews\Parsers;

use DiDom\Document;
use DiDom\Element;
use DOMText;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Support\Parser;
use Urbania\AppleNews\Support\Utils;
use Urbania\AppleNews\Contracts\HtmlHandlerMultiple;

class HtmlParser extends Parser
{
    protected $article = [];

    protected $mergeConsecutiveBody = true;

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

    protected $handlersOptions = [
        'addClassAsInlineStyle' => false,
    ];

    protected $handlers = [
        \Urbania\AppleNews\Parsers\Handlers\BodyHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\EmbedHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\GiphyHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\HeadingHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\ImageHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\ListHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\QuoteHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\TitleHandler::class
    ];

    protected $handlersCache = [];

    public function __construct($opts = [])
    {
        $this->setOptions($opts);
    }

    public function setOptions(array $opts)
    {
        if (isset($opts['article'])) {
            $this->article = $opts['article'];
        }

        if (isset($opts['mergeConsecutiveBody'])) {
            $this->mergeConsecutiveBody = $opts['mergeConsecutiveBody'];
        }

        if (isset($opts['moveUpContainers'])) {
            $this->moveUpContainers = $opts['moveUpContainers'];
        }

        if (isset($opts['handlers'])) {
            $this->handlers = $opts['handlers'];
        }

        if (isset($opts['handlersOptions'])) {
            $this->handlersOptions = $opts['handlersOptions'];
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
                    'format' => 'html',
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

    public function isFullyCompatible($html)
    {
        $document = new Document($html);
        $bodyElements = $document->find('body');
        $titleElements = $document->find('title');
        $body = sizeof($bodyElements) ? $bodyElements[0] : null;
        if (is_null($body)) {
            return false;
        }
        $innerNode = $this->getInnerNode($body);
        $blocks = $this->getBlocks($innerNode);

        $incompatibleBlocks = $this->getIncompatibleBlocks($blocks);
        return sizeof($incompatibleBlocks) === 0;
    }

    public function getHandlers()
    {
        return $this->handlers;
    }

    public function setHandlers($handlers)
    {
        $this->handlers = $handlers;
        $this->handlersCache = [];
        return $this;
    }

    public function addHandler($handler)
    {
        $this->handlers[] = $handler;
        return $this;
    }

    public function addHandlers($handlers)
    {
        $this->handlers = array_merge($this->handlers, $handlers);
        return $this;
    }

    protected function getHandlersInstances()
    {
        return array_map(function ($handler) {
            return is_string($handler) || is_array($handler) ? $this->getHandlerInstance($handler) : $handler;
        }, $this->getHandlers());
    }

    protected function getHandlerInstance($handler)
    {
        $class = is_array($handler) ? $handler['class'] : $handler;
        if (!isset($this->handlersCache[$class])) {
            $this->handlersCache[$class] = new $class(
                array_merge(
                    $this->handlersOptions,
                    is_array($handler) ? $handler : []
                )
            );
        }
        return $this->handlersCache[$class];
    }

    protected function getIncompatibleBlocks($blocks)
    {
        return array_reduce(
            $blocks,
            function ($foundBlocks, $block) {
                // If the block is compatible, don't check the children
                if ($this->isBlockCompatible($block)) {
                    return $foundBlocks;
                }

                // If the block doesn't have children, add it to incompatible
                if (!is_array($block) || !isset($block['blocks'])) {
                    return array_merge(
                        $foundBlocks,
                        [$block],
                    );
                }

                // If there is children and all children are compatible,
                // consider this block compatible too.
                $childIncomptabileBlocks = $this->getIncompatibleBlocks(
                    $block['blocks']
                );
                return sizeof($childIncomptabileBlocks) > 0 ? array_merge(
                    $foundBlocks,
                    $childIncomptabileBlocks
                ) : $foundBlocks;
            },
            []
        );
    }

    protected function isBlockCompatible($block)
    {
        // prettier-ignore
        return array_reduce(
            $this->getHandlersInstances(),
            function ($compatible, $handler) use ($block) {
                return $compatible || $handler->canHandle($block);
            },
            false
        );
    }

    protected function getComponentsFromBlocks($blocks, $components = [])
    {
        $components = array_reduce(
            $blocks,
            function ($components, $block) {
                // prettier-ignore
                return array_reduce(
                    $this->getHandlersInstances(),
                    function ($components, $handler) use ($block) {
                        return $handler->canHandle($block)
                            ? array_merge(
                                $components,
                                $handler instanceof HtmlHandlerMultiple
                                    ? $handler->handle($block)
                                    : [$handler->handle($block)]
                            )
                            : $components;
                    },
                    $components
                );
            },
            $components
        );

        if ($this->mergeConsecutiveBody) {
            $components = $this->mergeConsecutiveBodyComponents($components);
        }

        return $components;
    }

    protected function mergeConsecutiveBodyComponents($components)
    {
        $newComponents = [];
        $lastBodyComponent = null;
        foreach ($components as $component) {
            // prettier-ignore
            if ($component['role'] === 'body' &&
                isset($component['format']) &&
                $component['format'] === 'html'
            ) {
                if (is_null($lastBodyComponent)) {
                    $lastBodyComponent = $component;
                } else {
                    $lastBodyComponent['text'] .= PHP_EOL . $component['text'];
                }
                continue;
            }

            if (!is_null($lastBodyComponent)) {
                $newComponents[] = $lastBodyComponent;
                $lastBodyComponent = null;
            }

            $newComponents[] = $component;
        }

        if (!is_null($lastBodyComponent)) {
            $newComponents[] = $lastBodyComponent;
            $lastBodyComponent = null;
        }

        return $newComponents;
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

    protected function containsIframe($node)
    {
        $html = $node->html();
        return preg_match(
            '/<(amp-)iframe[^>]*><\/(amp-)iframe[^>]*>/i',
            $html
        ) === 1;
    }

    protected function containsImg($node)
    {
        $html = $node->html();
        return preg_match('/<(amp-)img[^>]*><\/(amp-)img[^>]*>/i', $html) === 1;
    }

    protected function isIframe($node)
    {
        return preg_match('/^(amp-)iframe$/i', $node->tag) === 1;
    }

    protected function isImg($node)
    {
        return preg_match('/^(amp-)img/i', $node->tag) === 1;
    }

    protected function isAmpImageAlternatives($element)
    {
        // prettier-ignore
        if (!$element->isTextNode() &&
            preg_match('/^amp-img/i', $element->tag) === 1
        ) {
            return $element->hasAttribute('placeholder') || $element->hasAttribute('fallback');
        }
        return false;
    }

    public function getBlocks($node, $nodeIsEmpty = false)
    {
        $lastWasInline = false;
        $blocks = array_reduce(
            $node->children(),
            function ($blocks, $element) use ($nodeIsEmpty) {
                $lastBlock = sizeof($blocks)
                    ? $blocks[sizeof($blocks) - 1]
                    : null;
                $lastWasInline =
                    !$nodeIsEmpty &&
                    !is_null($lastBlock) &&
                    (is_string($lastBlock) || $this->blockIsInline($lastBlock));
                if (!$lastWasInline && $this->shouldIgnoreElement($element)) {
                    return $blocks;
                }

                // Get the block from an element
                $block = $this->getBlockFromElement($element);

                // Check if we ignore the current block and only push the children
                // prettier-ignore
                if ($this->isMoveUpContainer($block) ||
                    $this->isWrapper($element)
                ) {
                    return $this->isFigure($block) ? array_merge(
                        $blocks,
                        array_slice($block['blocks'], 0, 1)
                    ) : array_merge(
                        $blocks,
                        isset($block['text'])
                            ? [$block['text']]
                            : $block['blocks']
                    );
                }

                $blocks[] = $block;
                return $blocks;
            },
            []
        );

        return $blocks;
    }

    protected function shouldIgnoreElement($element)
    {
        return $this->isNodeEmpty($element) &&
            !$this->containsIframe($element) &&
            (!$this->containsImg($element) ||
                $this->isAmpImageAlternatives($element));
    }

    protected function getChildBlocks($element)
    {
        return $this->allChildrenAreTextNodes($element)
            ? $element->text()
            : $this->getBlocks($element, $this->isNodeEmpty($element));
    }

    protected function getBlockFromElement($element)
    {
        if ($element->isTextNode()) {
            return $element->text();
        }

        $isIframe = $this->isIframe($element);
        $isImg = $this->isImg($element);
        $classes = $element->classes()->getAll();
        sort($classes);
        $tag = strtolower($element->tag);
        if ($isIframe) {
            $tag = 'iframe';
        } elseif ($isImg) {
            $tag = 'img';
        }
        $block = [
            'tag' => $tag,
            'class' => $classes,
            'attributes' => []
        ];

        if ($block['tag'] === 'a') {
            $block['attributes']['href'] = (string) $element->getAttribute(
                'href'
            );
        } elseif ($isIframe || $isImg) {
            $block['attributes']['src'] = (string) $element->getAttribute(
                'src'
            );
        }

        // Add the child blocks or text
        $childBlocks = $this->getChildBlocks($element);
        if (is_string($childBlocks) && !empty($childBlocks)) {
            $block['text'] = $childBlocks;
        } elseif (is_array($childBlocks) && sizeof($childBlocks) > 0) {
            $block['blocks'] = $childBlocks;
        }

        return $block;
    }

    protected function blockIsInline($block)
    {
        return in_array($block['tag'], ['span', 'strong', 'b', 'em', 'a']);
    }

    protected function isWrapper($element)
    {
        $nodeIsEmpty = $this->isNodeEmpty($element);
        $isIframeWrapper =
            $this->containsIframe($element) && !$this->isIframe($element);
        $isImgWrapper = $this->containsImg($element) && !$this->isImg($element);
        return $nodeIsEmpty && ($isIframeWrapper || $isImgWrapper);
    }

    protected function isFigure($block)
    {
        return !is_string($block) && $block['tag'] === 'figure';
    }

    protected function isMoveUpContainer($block)
    {
        return !is_string($block) &&
            array_reduce(
                $this->moveUpContainers,
                function ($ignore, $container) use ($block) {
                    return $ignore ||
                        $this->blocksAreEquals($container, $block);
                },
                false
            );
    }

    protected function blocksAreEquals($a, $b)
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
