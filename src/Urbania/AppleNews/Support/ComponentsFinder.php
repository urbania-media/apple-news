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
        // If the selector is a nested combined selector, we need to change the
        // current components and selector
        if ($selector instanceof CombinedSelectorNode && $selector->getSelector() instanceof CombinedSelectorNode) {
            $firstSelector = $selector->getSelector();
            $combinator = $selector->getCombinator();
            $components = $combinator === '+'
                ? $this->matchComponents($components, $firstSelector->getSelector())
                : $this->matchComponents($components, $firstSelector);
            $selector = $combinator === '+'
                ? new CombinedSelectorNode($firstSelector->getSubSelector(), $combinator, $selector->getSubSelector())
                : $selector->getSubSelector();
        }

        $matchingComponents = array_reduce(
            array_keys($components),
            function ($matchingComponents, $index) use ($components, $selector) {
                $component = $components[$index];

                // If it's a combined selector, handle with a method
                if ($selector instanceof CombinedSelectorNode) {
                    return array_merge(
                        $matchingComponents,
                        $this->matchComponentsWithCombinedSelector(
                            $selector,
                            $component,
                            $components
                        )
                    );
                }

                // Check if the selector match the current component
                if ($this->matchComponent($component, $selector)) {
                    $matchingComponents[] = $component;
                }

                // Check if it match any children
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

    protected function matchComponentsWithCombinedSelector($selector, $component, $siblings)
    {
        $parentSelector = $selector->getSelector();
        $subSelector = $selector->getSubSelector();
        $combinator = $selector->getCombinator();

        $parentMatch = $this->matchComponent(
            $component,
            $parentSelector
        );

        if ($combinator === '+') {
            $childrenComponents = isset($component->components) ? $this->matchComponents(
                $component->components,
                $selector
            ) : [];
            if ($parentMatch) {
                $index = array_search($component, $siblings, true);
                return array_merge(
                    $this->matchComponents(array_slice($siblings, $index + 1), $subSelector),
                    $childrenComponents
                );
            }
            return $childrenComponents;
        }

        if (isset($component->components)) {
            return $this->matchComponents(
                $component->components,
                $parentMatch ? $subSelector : $selector
            );
        }

        return [];
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
