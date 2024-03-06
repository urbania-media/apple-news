<?php

namespace Urbania\AppleNews\Scripts\Import;

use DiDom\Document as DomDocument;
use Urbania\AppleNews\Scripts\Utils;

class ObjectDocument extends Document
{
    protected $versionPattern = '/Apple News Format ([0-9.+-]+)/';
    protected $namespace = 'Format';

    protected $typedClasses = [
        'Format\\Component' => 'role',
        'Format\\Fill' => 'type',
        'Format\\Scene' => 'type',
        'Format\\DataFormat' => 'type',
        'Format\\Behavior' => 'type',
        'Format\\ComponentAnimation' => 'type',
    ];

    protected $typedChildClasses;

    public function getName()
    {
        $name = data_get($this->data, 'metadata.title');
        return preg_replace('/\s/', '', $this->trim($name));
    }

    public function getClassName()
    {
        return $this->getType($this->getName());
    }

    public function getProperties()
    {
        $section = collect(data_get($this->data, 'primaryContentSections', []))->first(function (
            $section
        ) {
            return $section['kind'] === 'properties';
        });

        $objectName = $this->getName();
        $fromClass = $this->getFromClass();
        $properties = collect(data_get($section, 'items', []))
            ->map(function ($item) use ($objectName, $fromClass) {
                $property = [
                    'name' => data_get($item, 'name'),
                    'type' => $this->getType(
                        collect(data_get($item, 'type'))
                            ->map(function ($item) {
                                return data_get($item, 'text');
                            })
                            ->join('')
                    ),
                    'required' => data_get($item, 'required', false),
                ];

                $property['description'] = collect(data_get($item, 'content', []))
                    ->map(function ($item) {
                        return collect(data_get($item, 'inlineContent', []))
                            ->map(function ($item) {
                                return data_get($item, 'text', data_get($item, 'code'));
                            })
                            ->filter(function ($item) {
                                return !empty($item);
                            })
                            ->join('');
                    })
                    ->filter(function ($item) {
                        return !empty($item);
                    })
                    ->join(PHP_EOL);

                if (
                    $readOnlyValue = $this->getReadOnlyValueFromDescription(
                        $property['description']
                    )
                ) {
                    $property['value'] = $readOnlyValue;
                    $property['read_only'] = true;
                }

                $property = collect(data_get($item, 'attributes', []))->reduce(function (
                    $property,
                    $attribute
                ) {
                    if (
                        $attribute['kind'] === 'minimum' ||
                        $attribute['kind'] === 'maximum' ||
                        $attribute['kind'] === 'default'
                    ) {
                        if ($property['type'] === 'int') {
                            $property[$attribute['kind']] = (int) data_get($attribute, 'value');
                        } elseif ($property['type'] === 'float') {
                            $property[$attribute['kind']] = (float) data_get($attribute, 'value');
                        } elseif ($property['type'] === 'boolean') {
                            $property[$attribute['kind']] = (bool) data_get($attribute, 'value');
                        } else {
                            $property[$attribute['kind']] = data_get($attribute, 'value');
                        }
                    } elseif ($attribute['kind'] === 'allowedValues') {
                        $property = $this->mergePossibleValues($attribute, $property);
                    } elseif ($attribute['kind'] === 'allowedTypes') {
                        $property = $this->mergePossibleTypes($attribute, $property);
                    }

                    return $property;
                }, $property);

                if (
                    !is_null($fromClass) &&
                    ($property['name'] === '*' || $property['name'] === 'Any Key')
                ) {
                    $property['name'] = strtolower($fromClass);
                    $property['type'] = 'map:' . $property['type'];
                } elseif (
                    $objectName === 'Heading' &&
                    $property['name'] === 'role' &&
                    !isset($property['value'])
                ) {
                    $property['value'] = $property['enum_values'][0];
                } elseif (
                    in_array($objectName, ['Error', 'Warning']) &&
                    strtolower($property['name']) === 'keypath'
                ) {
                    $property['type'] = 'array';
                }
                if (is_array($property['type'])) {
                    $property['type'] = Utils::sortTypes(
                        collect($property['type'])
                            ->unique()
                            ->toArray()
                    );
                    if (sizeof($property['type']) === 1) {
                        $property['type'] = $property['type'][0];
                    }
                }
                $property['typed'] = $this->isPropertyCreatesTyped($property);

                return $property;
            })
            ->toArray();

        if ($fromClass === 'Records' && sizeof($properties) <= 1) {
            $properties = [
                [
                    'name' => 'data',
                    'type' => 'map',
                ],
            ];
        } elseif (preg_match('/ArticleMetadataFields$/', $objectName) === 1) {
            $properties[] = [
                'name' => 'links',
                'type' => $this->getType('ArticleLinks'),
            ];
        }

        return $properties;
    }

    protected function getReadOnlyValueFromDescription($text)
    {
        if (preg_match('/type is always ([a-zA-Z0-9_-]+)\./', $text, $matches)) {
            return $matches[1];
        } elseif (preg_match('/Should be set to ([a-zA-Z0-9_-]+)\./', $text, $matches)) {
            return $matches[1];
        } elseif (preg_match('/should be ([a-zA-Z0-9_-]+) for a/', $text, $matches)) {
            return $matches[1];
        } elseif (preg_match('/This must be ([a-zA-Z0-9_-]+) for a/', $text, $matches)) {
            return $matches[1];
        } elseif (preg_match('/The type must be ([a-zA-Z0-9_-]+)./', $text, $matches)) {
            return $matches[1];
        } elseif (preg_match('/should always be set to ([a-zA-Z0-9_-]+)./', $text, $matches)) {
            return $matches[1];
        } elseif (
            preg_match(
                '/Always ([a-zA-Z0-9_-]+)( or [a-zA-Z0-9_-]+)? for (this|a|the)/',
                $text,
                $matches
            )
        ) {
            return $matches[1];
        }

        return preg_match(
            '/always has ((a|the) role of|the type) ([a-zA-Z0-9_-]+)./',
            $text,
            $matches
        )
            ? $matches[3]
            : null;
    }

    protected function mergePossibleTypes($attribute, $property)
    {
        $types = collect(data_get($attribute, 'values', []))
            ->map(function ($value) {
                return $this->getType(
                    collect($value)
                        ->map(function ($item) {
                            return $item['text'];
                        })
                        ->join('')
                );
            })
            ->unique()
            ->values()
            ->toArray();

        // If possible types is a string enum
        $stringEnumValues = array_reduce(
            $types,
            function ($stringListType, $type) {
                if (preg_match('/string\(([^)]+)\)/i', $type, $matches)) {
                    return array_map(function ($value) {
                        return json_decode(trim($value));
                    }, explode('|', $matches[1]));
                }
                return $stringListType;
            },
            null
        );
        if (!is_null($stringEnumValues)) {
            $enumTypes = array_map(function ($type) {
                return preg_match('/^string\([^)]+\)/', $type) === 1 ? 'string' : $type;
            }, $types);
            $otherTypeEnumValues = array_reduce(
                $enumTypes,
                function ($values, $type) {
                    if ($type === 'boolean') {
                        return array_merge($values, [true, false]);
                    }
                    return $values;
                },
                []
            );
            return array_merge($property, [
                'type' => 'enum:' . implode('|', $enumTypes),
                'enum_values' => array_merge($stringEnumValues, $otherTypeEnumValues),
            ]);
        }

        return array_merge($property, [
            'type' => $types,
        ]);
    }

    protected function mergePossibleValues($attribute, $property)
    {
        $type = $property['type'] ?? null;
        $property = array_merge($property, [
            'type' => !is_null($type)
                ? sprintf('enum:%s', is_array($type) ? implode('|', $type) : $type)
                : 'enum',
        ]);

        $values = data_get($attribute, 'values', []);
        if (sizeof($values) === 1 && $property['required']) {
            $property['type'] = $type;
            $property['value'] = $values[0];
            $property['read_only'] = true;
            return $property;
        }
        $property['enum_values'] = array_map(function ($value) {
            if (is_numeric($value)) {
                return strpos($value, '.') === false ? (int) $value : (float) $value;
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
        $typedPattern = '/^(.*?\b)?(' . implode('|', $typedClasses) . ')(\b.*)?$/';
        if (is_array($type)) {
            return array_reduce(
                $type,
                function ($isTyped, $type) use ($typedPattern) {
                    return $isTyped || preg_match($typedPattern, $type) !== 0;
                },
                false
            );
        }
        return preg_match($typedPattern, $type) !== 0;
    }

    protected function getType($type)
    {
        if (preg_match('/^\[([^\]]+)\]$/', $type, $matches)) {
            return 'array:' . $this->getType($matches[1]);
        } elseif (preg_match('/\.([a-z].*)$/', $type, $matches)) {
            return $this->getType(ucfirst($matches[1]));
        } elseif (preg_match('/string\(\"none\"\)/i', $type, $matches)) {
            return 'none';
        } elseif (preg_match('/^(Color|SupportedUnits|Code|Status)$/', $type)) {
            return $type;
        } elseif (
            preg_match('/^(SupportedArticleIdentifier|PublisherArticleIdentifier)$/', $type)
        ) {
            return 'string';
        } elseif (preg_match('/^(SupportedInternalURLs|SupportedURLs)$/', $type)) {
            return 'uri';
        } elseif (preg_match('/^([A-Z][^\.]+)\.([A-Z][^\.]+)$/', $type, $matches)) {
            return $this->getType($matches[1] . $matches[2]);
        } elseif (preg_match('/^[A-Z]/', $type)) {
            return $this->namespace . '\\' . $type;
        }
        return $type;
    }

    public function getFromClass()
    {
        $name = $this->getName();
        if (preg_match('/^(.*?)\.[a-z][a-zA-Z]+(Layouts|Styles)$/', $name, $matches)) {
            return $matches[2];
        } elseif (preg_match('/^(.*?)\.(campaignData|records)$/', $name)) {
            return 'Records';
        }
        return null;
    }

    public function getInherits()
    {
        $section = collect(data_get($this->data, 'relationshipsSections', []))->first(function (
            $section
        ) {
            return $section['type'] === 'inheritsFrom';
        });

        if (!isset($section)) {
            return null;
        }

        $inherits = collect(data_get($section, 'identifiers', []))
            ->map(function ($id) {
                $references = data_get($this->data, 'references');
                return isset($references) ? data_get($references[$id], 'title') : null;
            })
            ->filter(function ($name) {
                return !empty($name);
            })
            ->values()
            ->toArray();

        return $inherits;
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
        return data_get($this->data, 'abstract.0.text');
    }

    public function getVersion()
    {
        return data_get($this->data, 'metadata.platforms.0.introducedAt', '1.0') . '+';
    }

    public function getDeprecated()
    {
        return data_get($this->data, 'metadata.platforms.0.deprecated', false);
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
            $typeKeys = [];
            foreach ($properties as $property) {
                if ($property['name'] === $typedProperty) {
                    if (isset($property['enum_values'])) {
                        $typeKeys = array_merge($typeKeys, $property['enum_values']);
                    } elseif (isset($property['value'])) {
                        $typeKeys[] = $property['value'];
                    }
                }
            }
            if (sizeof($typeKeys)) {
                $childObjectName = $childObject->getName();
                foreach ($typeKeys as $typeKey) {
                    $types[$typeKey] = $childObjectName;
                }
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
            'deprecated' => $this->getDeprecated(),
            'from_class' => $this->getFromClass(),
            'extends' => $this->getExtends(),
            'typed' => $this->isTyped()
                ? [
                    'property' => $this->getTypedProperty(),
                    'types' => $this->getTypedClassesMap(),
                ]
                : null,
            'url' => $this->url,
            'properties' => $this->getProperties(),
        ];
    }
}
