<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;

class ObjectDocument extends Document
{
    protected $versionPattern = '/Apple News Format ([0-9]+\.[0-9]+\+?)/';
    protected $namespace = 'Format';

    protected $typedClasses = [
        'Format\\Component' => 'role',
        'Format\\Fill' => 'type',
        'Format\\Scene' => 'type',
        'Format\\DataFormat' => 'type',
        'Format\\Behavior' => 'type',
        'Format\\ComponentAnimation' => 'type'
    ];

    protected $typedChildClasses;

    public function getName()
    {
        $name = $this->document
            ->find('#main .topic-title .topic-heading')[0]
            ->text();
        return preg_replace('/\s/', '', $this->trim($name));
    }

    public function getClassName()
    {
        return $this->getType($this->getName());
    }

    public function getObjectsUrls()
    {
        $objects = parent::getObjectsUrls();
        $symbols = $this->document->find('a.symbolref');
        foreach ($symbols as $symbol) {
            $href = $symbol->getAttribute('href');
            $name = trim($symbol->text());
            $objects[$name] = $this->getAbsoluteUrl($href);
        }
        return $objects;
    }

    public function getProperties()
    {
        $fromClass = $this->getFromClass();
        $rows = $this->document->find('#properties .parametertable-row');
        $properties = [];
        foreach ($rows as $row) {
            $nameCell = $row->child(0);
            $descriptionCell = $row->child(1);
            $property = $this->getPropertyFromNameCell($nameCell);
            if (is_null($property)) {
                continue;
            }
            $property = $this->mergeDescriptionCellProperty(
                $descriptionCell,
                $property
            );
            if (!is_null($fromClass) && $property['name'] === '*') {
                $property['name'] = strtolower($fromClass);
                $property['type'] = 'map:' . $property['type'];
            }
            if (is_array($property['type'])) {
                usort($property['type'], function ($a, $b) {
                    return preg_match('/^[A-Z]/', $a) === 0 ? 1 : -1;
                });
            }
            $property['typed'] = $this->isPropertyCreatesTyped($property);
            $properties[] = $property;
        }
        return $properties;
    }

    protected function getPropertyFromNameCell($cell)
    {
        $property = [];
        $children = $cell->children();
        foreach ($children as $child) {
            if ($child->isTextNode()) {
                continue;
            }
            $classes = $child->classes();
            if ($classes->contains('parametertable-name')) {
                $property['name'] = $this->trim($child->text());
            } elseif ($classes->contains('parametertable-type')) {
                $property['type'] = $this->getType($this->trim($child->text()));
            }
        }
        return sizeof($property) ? $property : null;
    }

    protected function mergeDescriptionCellProperty($cell, $property)
    {
        $property = array_merge($property, [
            'required' => false
        ]);
        $firstChild = $cell->firstChild();
        $children = $firstChild->classes()->contains('description-wrapper')
            ? array_merge(
                $firstChild->children(),
                array_slice($cell->children(), 1)
            )
            : $cell->children();
        foreach ($children as $child) {
            if ($child->isTextNode()) {
                continue;
            }
            $classes = $child->classes();
            if ($classes->contains('parametertable-requirement')) {
                $property['required'] =
                    $this->trim($child->text()) === '(Required)';
            } elseif ($classes->contains('parametertable-description')) {
                $property = $this->mergeDescriptionProperty($child, $property);
            } elseif ($classes->contains('parametertable-metadata')) {
                $property = $this->mergeMetadataProperty($child, $property);
            }
        }
        return $property;
    }

    protected function mergeDescriptionProperty($node, $property)
    {
        $property = array_merge($property, []);
        $children = $node->firstChild()->children();
        foreach ($children as $child) {
            if ($child->isTextNode()) {
                continue;
            }
            if ($child->tag === 'p') {
                $text = $this->trim($child->text());
                if (!isset($property['description'])) {
                    $property['description'] = $text;
                    if ($readOnlyValue = $this->getReadOnlyValueFromDescription(
                        $text
                    )
                    ) {
                        $property['value'] = $readOnlyValue;
                        $property['read_only'] = true;
                    }
                } elseif (preg_match('/^Version ([0-9]+\.[0-9])/', $text, $matches)
                ) {
                    $property['version'] = $matches[1];
                }
            }
        }

        return $property;
    }

    protected function getReadOnlyValueFromDescription($text)
    {
        if (preg_match('/type is always ([a-zA-Z0-9_-]+)\./', $text, $matches)
        ) {
            return $matches[1];
        } elseif (preg_match('/Should be set to ([a-zA-Z0-9_-]+)\./', $text, $matches)
        ) {
            return $matches[1];
        } elseif (preg_match('/should be ([a-zA-Z0-9_-]+) for a/', $text, $matches)
        ) {
            return $matches[1];
        } elseif (preg_match('/This must be ([a-zA-Z0-9_-]+) for a/', $text, $matches)
        ) {
            return $matches[1];
        } elseif (preg_match('/The type must be ([a-zA-Z0-9_-]+)./', $text, $matches)
        ) {
            return $matches[1];
        } elseif (preg_match('/should always be set to ([a-zA-Z0-9_-]+)./', $text, $matches)
        ) {
            return $matches[1];
        }
        return preg_match(
            '/always has (a role of|the type) ([a-zA-Z0-9_-]+)./',
            $text,
            $matches
        )
            ? $matches[2]
            : null;
    }

    protected function mergeMetadataProperty($node, $property)
    {
        $property = array_merge($property, []);
        $text = $this->trim($node->text());
        if (preg_match('/^(Default|Minimum|Maximum)\: (.*)$/', $text, $matches)) {
            if (is_numeric($matches[2])) {
                if ($property['type'] === 'integer') {
                    $property[strtolower($matches[1])] = (int) $matches[2];
                } else {
                    $property[strtolower($matches[1])] = (float) $matches[2];
                }
            } else {
                $property[strtolower($matches[1])] = $matches[2];
            }
        } elseif (preg_match('/^Possible types\: /', $text)) {
            $property = $this->mergePossibleTypes($node, $property);
        } elseif (preg_match('/^Possible values\: /', $text)) {
            $property = $this->mergePossibleValues($node, $property);
        }
        return $property;
    }

    protected function mergePossibleTypes($node, $property)
    {
        $children = $node->firstChild()->children();
        $types = array_map(function ($type) {
            return $this->getType($type);
        }, $this->getMetadataValues($children));

        return array_merge($property, [
            'type' => $types
        ]);
    }

    protected function mergePossibleValues($node, $property)
    {
        $type = $property['type'] ?? null;
        $property = array_merge($property, [
            'type' => !is_null($type)
                ? sprintf(
                    'enum:%s',
                    is_array($type) ? implode('|', $type) : $type
                )
                : 'enum'
        ]);

        $children = $node->firstChild()->children();
        $values = $this->getMetadataValues($children);
        $property['enum_values'] = array_map(function ($value) {
            if (is_numeric($value)) {
                return strpos($value, '.') === false
                    ? (int) $value
                    : (float) $value;
            } elseif ($value === 'true' || $value === 'false') {
                return $value === 'true';
            }
            return $value;
        }, $values);

        return $property;
    }

    protected function getMetadataValues($children)
    {
        $values = [];
        foreach ($children as $child) {
            if ($child->isTextNode()) {
                continue;
            }
            if ($child->tag === 'code') {
                $values = explode(', ', $this->trim($child->text()));
            }
        }
        return $values;
    }

    protected function isPropertyCreatesTyped($property)
    {
        $type = $property['type'] ?? null;
        $typedClasses = array_map(function ($class) {
            return preg_quote($class, '/');
        }, array_keys($this->typedClasses));
        $typedPattern ='/^(.*?\b)?('.implode('|', $typedClasses).')(\b.*)?$/';
        if (is_array($type)) {
            return array_reduce($type, function ($isTyped, $type) use ($typedPattern) {
                return $isTyped || preg_match($typedPattern, $type) !== 0;
            }, false);
        }
        return preg_match($typedPattern, $type) !== 0;
    }

    protected function getType($type)
    {
        if (preg_match('/^\[([^\]]+)\]$/', $type, $matches)) {
            return 'array:' . $this->getType($matches[1]);
        } elseif (preg_match('/\.([a-z].*)$/', $type, $matches)) {
            return $this->getType(ucfirst($matches[1]));
        } elseif (preg_match('/^(Color|SupportedUnits)$/', $type)) {
            return $type;
        } elseif (preg_match('/^([A-Z][^\.]+)\.([A-Z][^\.]+)$/', $type, $matches)) {
            return $this->getType($matches[1].$matches[2]);
        } elseif (preg_match('/^[A-Z]/', $type)) {
            return $this->namespace . '\\' . $type;
        }
        return $type;
    }

    public function getFromClass()
    {
        $name = $this->getName();
        if (preg_match(
            '/^(.*?)\.[a-z][a-zA-Z]+(Layouts|Styles)$/',
            $name,
            $matches
        )
        ) {
            return $matches[2];
        }
        return null;
    }

    public function getInherits()
    {
        if ($this->document->has('#inherits-from .symbol-name')) {
            $nodes = $this->document->find('#inherits-from .symbol-name');
            return array_map(function ($node) {
                return $this->trim($node->text());
            }, $nodes);
        }
        return null;
    }

    public function hasMultipleInherits()
    {
        $inherits = $this->getInherits();
        return !is_null($inherits) && sizeof($inherits) > 1;
    }

    public function getExtends()
    {
        $ihnerits = $this->getInherits();
        return !is_null($ihnerits) && sizeof($ihnerits) ? $this->getType($ihnerits[0]) : null;
    }

    public function getDescription()
    {
        if ($this->document->has('#main .topic-description')) {
            $node = $this->document->find('#main .topic-description');
            return $this->trim($node[0]->text());
        }
        return null;
    }

    public function getVersion()
    {
        if ($this->document->has('#main .topic-summary .sdk')) {
            $node = $this->document->find('#main .topic-summary .sdk');
            $text = $this->trim($node[0]->text());
            if (preg_match($this->versionPattern, $text, $matches)) {
                return $matches[1];
            }
            return '1.0+';
        }
        return '1.0+';
    }

    public function isTyped()
    {
        return isset($this->typedClasses[$this->getClassName()]);
    }

    public function getTypedChildClasses()
    {
        return $this->typedChildClasses;
    }

    public function getTypedProperty()
    {
        return $this->typedClasses[$this->getClassName()] ?? null;
    }

    public function setTypedChildClasses($classes)
    {
        $this->typedChildClasses = $classes;
        return $this;
    }

    public function getTypedClassesMap()
    {
        $typedProperty = $this->isTyped() ? $this->getTypedProperty() : null;
        $types = [];
        foreach ($this->getTypedChildClasses() as $childObject) {
            $properties = $childObject->getProperties();
            $typeKey = null;
            foreach ($properties as $property) {
                if ($property['name'] === $typedProperty) {
                    $typeKey = $property['value'] ?? null;
                }
            }
            if (!is_null($typeKey)) {
                $types[$typeKey] = $childObject->getName();
            }
        }
        return $types;
    }

    public function toArray()
    {
        return [
            'name' => $this->getType($this->getName()),
            'description' => $this->getDescription(),
            'version' => $this->getVersion(),
            'from_class' => $this->getFromClass(),
            'extends' => $this->getExtends(),
            'typed' => $this->isTyped() ? [
                'property' => $this->getTypedProperty(),
                'types' => $this->getTypedClassesMap(),
            ] : null,
            'url' => $this->url,
            'properties' => $this->getProperties()
        ];
    }
}
