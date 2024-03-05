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
        'addClassAsInlineStyle' => false
    ];

    protected $handlers = [
        \Urbania\AppleNews\Parsers\Handlers\InstagramHandler::class,
        \Urbania\AppleNews\Parsers\Handlers\TiktokHandler::class,
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
            return is_string($handler) || is_array($handler)
                ? $this->getHandlerInstance($handler)
                : $handler;
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

    /**
     * Get incompatible blocks
     * @param  array $blocks All the blocks
     * @return array
     */
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
                    return array_merge($foundBlocks, [$block]);
                }

                // If there is children and all children are compatible,
                // consider this block compatible too.
                $childIncomptabileBlocks = $this->getIncompatibleBlocks(
                    $block['blocks']
                );
                return sizeof($childIncomptabileBlocks) > 0
                    ? array_merge($foundBlocks, $childIncomptabileBlocks)
                    : $foundBlocks;
            },
            []
        );
    }

    /**
     * Check if a block is compatible agains handlers
     * @param  array|string  $block The block
     * @return boolean
     */
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

    /**
     * Get Apple News components from blocks
     * @param  array $blocks The blocks to convert to components
     * @param  array $components The previous components when using recursively
     * @return array
     */
    protected function getComponentsFromBlocks($blocks, $components = [])
    {
        $handlers = collect($this->getHandlersInstances());
        $components = array_reduce(
            $blocks,
            function ($components, $block) use ($handlers) {

                $handler = $handlers->first(function ($handler) use ($block) {
                    return $handler->canHandle($block);
                });

                return isset($handler) ? array_merge(
                    $components,
                    $handler instanceof HtmlHandlerMultiple
                        ? $handler->handle($block)
                        : [$handler->handle($block)]
                )
                : $components;
            },
            $components
        );

        if ($this->mergeConsecutiveBody) {
            $components = $this->mergeConsecutiveBodyComponents($components);
        }

        return $components;
    }

    /**
     * Merge all consecutive html body components
     * @param  array $components The components
     * @return array
     */
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

    /**
     * Remove wrapper nodes
     * @param  Element $node The node to traverse
     * @return Element
     */
    public function getInnerNode($node)
    {
        $children = $node->children();
        $notEmptyChildren = [];
        foreach ($children as $child) {
            if (!$this->isNodeEmpty($child) || $this->isNodeContainsIframe($child)) {
                $notEmptyChildren[] = $child;
            }
        }
        return sizeof($notEmptyChildren) === 1
            ? $this->getInnerNode($notEmptyChildren[0])
            : $node;
    }

    /**
     * Get blocks from a node
     * @param  Element  $node The element to transform into blocks
     * @return array
     */
    public function getBlocks($node)
    {
        $lastWasInline = false;
        $nodeIsEmpty = $this->isNodeEmpty($node);
        $blocks = array_reduce(
            $node->children(),
            function ($blocks, $element) use ($nodeIsEmpty) {
                $lastBlock = sizeof($blocks)
                    ? $blocks[sizeof($blocks) - 1]
                    : null;
                $lastBlockIsInline =
                    !$nodeIsEmpty &&
                    !is_null($lastBlock) &&
                    $this->isBlockInline($lastBlock);
                // prettier-ignore
                if ((!$lastBlockIsInline && $this->shouldIgnoreElement($element)) ||
                    ($lastBlockIsInline && $this->isNodeEmpty($element, true))
                ) {
                    return $blocks;
                }

                // Get the block from an element
                $block = $this->getBlockFromElement($element);

                // Check if we ignore the current block and only push the children
                // prettier-ignore
                if ($this->isBlockMoveUpContainer($block) ||
                    $this->isNodeWrapper($element)
                ) {
                    return $this->isBlockFigure($block) ? array_merge(
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
            !$this->isNodeContainsIframe($element) &&
            (!$this->isNodeContainsImg($element) ||
                $this->isNodeAmpImageAlternatives($element));
    }

    protected function getBlockFromElement($element)
    {
        if ($element->isTextNode()) {
            return $element->text();
        }

        $isIframe = $this->isNodeIframe($element);
        $isImg = $this->isNodeImg($element);
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
            'attributes' => $element->attributes()
        ];

        if ($block['tag'] === 'a') {
            $block['attributes']['href'] = $this->cleanLink(
                (string) $element->getAttribute('href')
            );
        } elseif ($isIframe || $isImg) {
            $block['attributes']['src'] = $this->cleanLink(
                (string) $element->getAttribute('src')
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

    /**
     * Get the child blocks of a node
     * @param  Element $node The node to get children
     * @return string|array
     */
    protected function getChildBlocks($node)
    {
        return $this->allChildrenAreTextNodes($node)
            ? $node->text()
            : $this->getBlocks($node);
    }

    /**
     * Check if all children are text nodes
     * @param  Element $node The node to check
     * @return boolean
     */
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

    /**
     * Check if a node contains text
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeEmpty($node, $spaceOnly = false)
    {
        $text = $node->text();
        $trimedText = static::trimText($text);
        return empty($trimedText) &&
            (!$spaceOnly || preg_match('/^\s*$/us', $text) === 1);
    }

    /**
     * Check if a node contains an iframe
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeContainsIframe($node)
    {
        $html = $node->html();
        return preg_match(
            '/<(amp-)?iframe[^>]*>/i',
            $html
        ) === 1;
    }

    /**
     * Check if a node contains an image
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeContainsImg($node)
    {
        $html = $node->html();
        return preg_match('/<(amp-)?img[^>]*>/i', $html) === 1;
    }

    /**
     * Check if a node is an iframe
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeIframe($node)
    {
        return preg_match('/^(amp-)?iframe$/i', $node->tag) === 1;
    }

    /**
     * Check if a node is an image
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeImg($node)
    {
        return preg_match('/^(amp-)?img/i', $node->tag) === 1;
    }

    /**
     * Check if a node is an alternative amp image
     * @param  Element $node The node to check
     * @return boolean
     */
    protected function isNodeAmpImageAlternatives($node)
    {
        // prettier-ignore
        if (!$node->isTextNode() &&
            preg_match('/^amp-img/i', $node->tag) === 1
        ) {
            return $node->hasAttribute('placeholder') || $node->hasAttribute('fallback');
        }
        return false;
    }

    /**
     * Check if a node is only a wrapper
     * @param  Element  $node The node to check
     * @return boolean
     */
    protected function isNodeWrapper($node)
    {
        $nodeIsEmpty = $this->isNodeEmpty($node);
        $isIframeWrapper =
            $this->isNodeContainsIframe($node) && !$this->isNodeIframe($node);
        $isImgWrapper =
            $this->isNodeContainsImg($node) && !$this->isNodeImg($node);
        return $nodeIsEmpty && ($isIframeWrapper || $isImgWrapper);
    }

    /**
     * Check if a block is empty
     * @param  string|array  $block The block to check
     * @return boolean
     */
    protected function isBlockInline($block)
    {
        return is_string($block) ||
            in_array($block['tag'], ['span', 'strong', 'b', 'em', 'a']);
    }

    /**
     * Check if a block is a figure
     * @param  string|array  $block The block to check
     * @return boolean
     */
    protected function isBlockFigure($block)
    {
        return !is_string($block) && $block['tag'] === 'figure';
    }

    /**
     * Check if the block is a move up container
     * @param  string|array  $block The block to check
     * @return boolean
     */
    protected function isBlockMoveUpContainer($block)
    {
        return !is_string($block) &&
            array_reduce(
                $this->moveUpContainers,
                function ($ignore, $container) use ($block) {
                    return $ignore || $this->blocksEquals($container, $block);
                },
                false
            );
    }

    /**
     * Check if blocks are equals
     * @param  string|array $a The first block
     * @param  string|array $b The second block
     * @return boolean
     */
    protected function blocksEquals($a, $b)
    {
        if (is_string($a) || is_string($b)) {
            return $a === $b;
        }
        $aClass = (array) $a['class'];
        $bClass = (array) $b['class'];
        return $a['tag'] === $b['tag'] &&
            sizeof(array_diff($aClass, $bClass)) === 0;
    }

    /**
     * Trim multi-lines text
     * @param  string $text The text to trim
     * @return string
     */
    public static function trimText($text)
    {
        return preg_replace('/^[\s\n\t]*(.*?)[\s\n\t]*$/us', '$1', $text);
    }

    /**
     * Clean links
     * @param  string $link The link
     * @return string
     */
    public static function cleanLink($link)
    {
        return preg_replace('/^\%20/', '', trim($link));
    }
}
