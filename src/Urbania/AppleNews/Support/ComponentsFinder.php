<?php

namespace Urbania\AppleNews\Support;

use Symfony\Component\CssSelector\Parser\Parser as CssParser;
use Symfony\Component\CssSelector\Node\CombinedSelectorNode;
use Symfony\Component\CssSelector\Node\HashNode;
use Symfony\Component\CssSelector\Node\ElementNode;
use Symfony\Component\CssSelector\Node\AttributeNode;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ComponentsFinder
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new CssParser();
    }

    public function find($selector, $components)
    {
        if (is_object($components)) {
            $components = $components->components;
        }

        $selectors = $this->parser->parse($selector);
        $foundComponents = [];
        foreach ($selectors as $selector) {
            $tree = $selector->getTree();

            $matchComponents = $this->matchComponents($components, $tree);
            $foundComponents = array_merge($foundComponents, $matchComponents);
        }
        return $foundComponents;
    }

    protected function matchComponents(
        $components,
        $selector,
        $applyFilter = true
    ) {
        $matchingComponents = array_reduce(
            $components,
            function ($matchingComponents, $component) use ($selector) {
                if ($selector instanceof CombinedSelectorNode) {
                    if (!isset($component->components)) {
                        return $matchingComponents;
                    }
                    $parentSelector = $selector->getSelector();
                    $subSelector = $selector->getSubSelector();
                    $parentMatch = $this->matchComponent(
                        $component,
                        $parentSelector
                    );
                    $matchingComponents = array_merge(
                        $matchingComponents,
                        $this->matchComponents(
                            $component->components,
                            $parentMatch ? $subSelector : $selector
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
                                $selector,
                                false
                            )
                        );
                    }
                }
                return $matchingComponents;
            },
            []
        );

        if ($applyFilter && $selector instanceof FunctionNode) {
            $matchingComponents = $this->filterComponents(
                $matchingComponents,
                $selector
            );
        }

        return $matchingComponents;
    }

    protected function filterComponents($components, $selector)
    {
        $functionName = $selector->getName();
        if ($functionName === 'eq') {
            $arguments = $selector->getArguments();
            $index = (int) $arguments[0]->getValue();
            $component = isset($components[$index])
                ? $components[$index]
                : null;
            return !is_null($component) ? [$component] : [];
        }
        return $components;
    }

    protected function matchComponent($component, $selector)
    {
        if ($selector instanceof HashNode) {
            return $selector->getId() ===
                (isset($component->identifier) ? $component->identifier : null);
        } elseif ($selector instanceof ElementNode) {
            $element = $selector->getElement();
            return is_null($element) ||
                $element ===
                    (isset($component->role) ? $component->role : null);
        } elseif ($selector instanceof AttributeNode) {
            $attribute = $selector->getAttribute();
            $value = $selector->getValue();
            $subSelector = $selector->getSelector();
            return isset($component[$attribute]) &&
                $component[$attribute] == $value &&
                $this->matchComponent($component, $subSelector);
        } elseif ($selector instanceof FunctionNode) {
            return $this->matchFunctionComponent($component, $selector);
        }
        return false;
    }

    protected function matchFunctionComponent($component, $selector)
    {
        $subSelector = $selector->getSelector();
        $functionName = $selector->getName();
        if ($functionName === 'eq') {
            return $this->matchComponent($component, $subSelector);
        }

        return false;
    }
}
