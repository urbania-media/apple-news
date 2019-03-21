<?php

namespace Urbania\AppleNews\Support;

use Symfony\Component\CssSelector\Parser\Parser;
use Symfony\Component\CssSelector\Node\CombinedSelectorNode;
use Symfony\Component\CssSelector\Node\HashNode;
use Symfony\Component\CssSelector\Node\ElementNode;
use Symfony\Component\CssSelector\Node\AttributeNode;

class ComponentsFinder
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function find($selector, $components)
    {
        $selectors = $this->parser->parse($selector);
        $foundComponents = [];
        foreach ($selectors as $selector) {
            $tree = $selector->getTree();

            $matchComponents = $this->matchComponents($components, $tree);
            $foundComponents = array_merge($foundComponents, $matchComponents);
        }
        return $foundComponents;
    }

    protected function matchComponents($components, $selector)
    {
        return array_reduce(
            $components,
            function ($matchingComponents, $component) use ($selector) {
                if ($selector instanceof CombinedSelectorNode) {
                    if (!isset($component->components)) {
                        return $matchingComponents;
                    }
                    $parentSelector = $selector->getSelector();
                    $subSelector = $selector->getSubSelector();
                    $matchingComponents = array_merge(
                        $matchingComponents,
                        $this->matchComponents(
                            $component->components,
                            $this->matchComponent($component, $parentSelector)
                                ? $subSelector
                                : $selector
                        )
                    );
                } else {
                    if ($this->matchComponent($component, $selector)) {
                        $matchingComponents[] = $component;
                    }
                    if (isset($component->components)) {
                        $matchingComponents = array_merge(
                            $matchingComponents,
                            $this->matchComponents(
                                $component->components,
                                $selector
                            )
                        );
                    }
                }
                return $matchingComponents;
            },
            []
        );
    }

    protected function matchComponent($component, $selector)
    {
        if ($selector instanceof HashNode) {
            return $selector->getId() === ($component->identifier ?? null);
        } elseif ($selector instanceof ElementNode) {
            $element = $selector->getElement();
            return is_null($element) ||
                $element === ($component->role ?? null);
        } elseif ($selector instanceof AttributeNode) {
            $attribute = $selector->getAttribute();
            $value = $selector->getValue();
            $subSelector = $selector->getSelector();
            return isset($component[$attribute]) &&
                $component[$attribute] == $value &&
                $this->matchComponent($component, $subSelector);
        }
        return false;
    }
}
