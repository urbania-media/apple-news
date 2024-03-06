<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;
use Illuminate\Support\Str;

class ObjectSetMethodBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $property, string $baseNamespace)
    {
        $studlyName = Utils::studlyCase($property['name']);
        $method = new Method('set' . $studlyName);
        $readOnly = $property['read_only'] ?? false;
        $method->setVisibility($readOnly ? 'protected' : 'public');

        $isRequired = $property['required'] ?? false;
        $lines = array_filter(
            [
                !$isRequired ? $this->buildUnsetBody($property) . PHP_EOL : null,
                $this->buildAssertionBody($property, $baseNamespace) . PHP_EOL,
                $this->buildMethodBody($property, $baseNamespace),
                'return $this;',
            ],
            function ($line) {
                return !is_null($line);
            }
        );
        $method->setBody(implode(PHP_EOL, array_values($lines)));

        $method->addParameter($property['name']);

        $method->addComment(sprintf('Set the %s', $property['name']));
        $method->addComment(
            sprintf(
                '@param %s $%s',
                $this->getTypeHint($property['type'], 'set'),
                $property['name']
            )
        );
        $method->addComment('@return $this');

        return $method;
    }

    protected function buildUnsetBody($property)
    {
        $variableName = '$' . $property['name'];
        return sprintf(
            'if(is_null(%s)) {' . '$this->%s = null;' . 'return $this;' . '}',
            $variableName,
            $property['name']
        );
    }

    protected function buildAssertionBody($property, $baseNamespace)
    {
        $type = $property['type'];
        if (is_array($type)) {
            return $this->buildMultipleAssertionBody($type, $property, $baseNamespace);
        }
        return $this->buildSingleAssertionBody($type, $property, $baseNamespace);
    }

    protected function buildMultipleAssertionBody($type, $property, $baseNamespace)
    {
        $lastIndex = sizeof($type) - 1;
        if (sizeof($type) === 1) {
            return $this->buildSingleAssertionBody($type, $property, $baseNamespace);
        } elseif (sizeof($type) === 2 || $type[$lastIndex] === 'none') {
            $firstIsObject = preg_match('/^[A-Z]/', $type[0]) === 1;
            $firstIsArray = preg_match('/^array/', $type[0]) === 1;
            $secondIsPrimitive = preg_match('/^[a-z]/', $type[1]) === 1;
            $lastIsPrimitive = preg_match('/^[a-z]/', $type[$lastIndex]) === 1;
            if (sizeof($type) === 2 && $type[0] === 'Color' && $type[1] === 'none') {
                return sprintf(
                    'if($%1$s !== "none") { %2$s }',
                    $property['name'],
                    $this->buildSingleAssertionBody($type[0], $property, $baseNamespace)
                );
            } elseif ($type[0] === 'SupportedUnits' && $secondIsPrimitive) {
                return $this->buildSingleAssertionBody('SupportedUnits', $property, $baseNamespace);
            } elseif ($firstIsObject && $secondIsPrimitive) {
                return sprintf(
                    'if(is_object($%1$s) || Utils::isAssociativeArray($%1$s)) { %2$s } else { %3$s }',
                    $property['name'],
                    $this->buildSingleAssertionBody($type[0], $property, $baseNamespace),
                    $this->buildSingleAssertionBody($type[1], $property, $baseNamespace)
                );
            } elseif ($firstIsArray && $secondIsPrimitive) {
                return sprintf(
                    'if(is_array($%1$s)) { %2$s } else { %3$s }',
                    $property['name'],
                    $this->buildSingleAssertionBody($type[0], $property, $baseNamespace),
                    $this->buildSingleAssertionBody($type[1], $property, $baseNamespace)
                );
            } elseif ($lastIsPrimitive) {
                $relativeClassPaths = array_map(function ($type) use ($baseNamespace) {
                    return $this->getRelativeClassPathFromObjectName($type, $baseNamespace) .
                        '::class';
                }, array_slice($type, 0, -1));
                return sprintf(
                    'if(is_object($%1$s) || Utils::isAssociativeArray($%1$s)) { %2$s } else { %3$s }',
                    $property['name'],
                    sprintf(
                        'Assert::isAnySdkObject($%s, [%s]);',
                        $property['name'],
                        implode(',', $relativeClassPaths)
                    ),
                    $this->buildSingleAssertionBody($type[$lastIndex], $property, $baseNamespace)
                );
            } else {
                $relativeClassPaths = array_map(function ($type) use ($baseNamespace) {
                    return $this->getRelativeClassPathFromObjectName($type, $baseNamespace) .
                        '::class';
                }, $type);

                return sprintf(
                    'Assert::isAnySdkObject($%s, [%s]);',
                    $property['name'],
                    implode(',', $relativeClassPaths)
                );
            }
        } elseif (in_array('SupportedUnits', $type)) {
            $objectType = array_reduce(
                $type,
                function ($objectType, $type) {
                    if ($type !== 'SupportedUnits' && preg_match('/^[A-Z]/', $type) === 1) {
                        return $type;
                    }
                    return $objectType;
                },
                null
            );
            return !is_null($objectType)
                ? sprintf(
                    'if(is_object($%1$s) || is_array($%1$s)) { %2$s } else { %3$s }',
                    $property['name'],
                    $this->buildSingleAssertionBody($objectType, $property, $baseNamespace),
                    $this->buildSingleAssertionBody('SupportedUnits', $property, $baseNamespace)
                )
                : $this->buildSingleAssertionBody('SupportedUnits', $property, $baseNamespace);
        }
        return '';
    }

    protected function buildSingleAssertionBody($type, $property, $baseNamespace)
    {
        $typeParts = explode(':', $type);
        $mainType = $typeParts[0];
        $variableName = '$' . $property['name'];
        $lines = [];
        switch ($mainType) {
            case 'date-time':
                $lines[] = sprintf('Assert::isDate(%s);', $variableName);
                break;

            case 'SupportedUnits':
                $lines[] = sprintf('Assert::isSupportedUnits(%s);', $variableName);
                break;

            case 'Color':
                $lines[] = sprintf('Assert::isColor(%s);', $variableName);
                break;

            case 'Code':
                $lines[] = sprintf('Assert::string(%s);', $variableName);
                break;

            case 'Status':
                $lines[] = sprintf('Assert::integer(%s);', $variableName);
                break;

            case 'uuid':
                $lines[] = sprintf('Assert::uuid(%s);', $variableName);
                break;

            case 'none':
                $lines[] = sprintf('Assert::eq(%s, %s);', $variableName, json_encode('none'));
                break;

            case 'enum':
                if (isset($property['enum_values'])) {
                    $lines[] = sprintf(
                        'Assert::oneOf(%s, %s);',
                        $variableName,
                        json_encode($property['enum_values'])
                    );
                } else {
                    $lines[] = sprintf('Assert::isArray(%s);', $variableName);
                }
                break;

            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if ($mainType === 'map') {
                    $lines[] = sprintf(
                        'if(is_array(%1$s) && sizeof(%1$s) > 0) { Assert::isMap(%1$s); }',
                        $variableName
                    );
                } else {
                    $lines[] = sprintf('Assert::isArray(%s);', $variableName);
                }
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    $relativeClassPath = $this->getRelativeClassPathFromObjectName(
                        $itemType,
                        $baseNamespace
                    );
                    $lines[] = sprintf(
                        $itemType === 'Format\\Component'
                            ? 'Assert::allIsComponent(%s);'
                            : 'Assert::allIsSdkObject(%s, %s::class);',
                        $variableName,
                        $relativeClassPath
                    );
                } elseif (!is_null($itemType)) {
                    $lines[] = sprintf(
                        'Assert::all%s(%s);',
                        Utils::studlyCase($itemType),
                        $variableName
                    );
                }
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    if ($mainType === 'Format\\Component') {
                        $lines[] = sprintf('Assert::isComponent(%s);', $variableName);
                    } else {
                        $relativeClassPath = $this->getRelativeClassPathFromObjectName(
                            $mainType,
                            $baseNamespace
                        );
                        $lines[] = sprintf(
                            'Assert::isSdkObject(%s, %s::class);',
                            $variableName,
                            $relativeClassPath
                        );
                    }
                } else {
                    $lines[] = sprintf('Assert::%s(%s);', $mainType, $variableName);
                }
                break;
        }
        return implode(PHP_EOL, $lines);
    }

    protected function buildMethodBody($property, $baseNamespace)
    {
        $lines = [];
        $typeParts = explode(
            ':',
            is_array($property['type']) ? $property['type'][0] : $property['type']
        );
        $mainType = $typeParts[0];
        switch ($mainType) {
            case 'date-time':
                $lines[] = sprintf(
                    '$this->%s = is_string($%1$s) ? Carbon::parse($%1$s) : $%1$s;',
                    $property['name']
                );
                break;
            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    $lines[] = sprintf(
                        '$this->%1$s = is_array($%1$s) ? array_reduce(array_keys($%1$s), function ($array, $key) use ($%1$s) {' .
                            '$item = $%1$s[$key];' .
                            $this->buildSetObjectPropertyBody(
                                $property,
                                $itemType,
                                $baseNamespace,
                                true
                            ) .
                            'return $array;' .
                            '}, []) : $%1$s;',
                        $property['name']
                    );
                } else {
                    $lines[] = $this->buildSetPropertyBody($property);
                }
                break;
            case 'SupportedUnits':
            case 'Color':
            case 'Code':
            case 'Status':
                $lines[] = $this->buildSetPropertyBody($property);
                break;
            default:
                if (
                    is_array($property['type']) &&
                    $this->typesAreDisplayObjects($property['type'])
                ) {
                    $lines[] = $this->buildSetDisplayObjectPropertyBody($property, $baseNamespace);
                } elseif (preg_match('/^[A-Z]/', $mainType)) {
                    $lines[] = $this->buildSetObjectPropertyBody(
                        $property,
                        $mainType,
                        $baseNamespace
                    );
                } else {
                    $lines[] = $this->buildSetPropertyBody($property);
                }
                break;
        }
        return implode(PHP_EOL, $lines);
    }

    protected function typesAreDisplayObjects($types)
    {
        return array_reduce(
            $types,
            function ($displayObjects, $type) {
                return $displayObjects && preg_match('/^Format\\\(.*?)Display$/', $type) === 1;
            },
            true
        );
    }

    protected function buildSetDisplayObjectPropertyBody($property, $baseNamespace)
    {
        $types = array_reduce($property['type'], function ($types, $type) use ($baseNamespace) {
            preg_match('/^Format\\\(.*?)Display$/', $type, $matches);
            $typeKey = Utils::snakeCase($matches[1]);
            $types[] = [
                'key' => $typeKey,
                'classPath' => $this->getRelativeClassPathFromObjectName($type, $baseNamespace),
            ];
            return $types;
        });
        $typeKeys = array_map(function ($type) {
            return sprintf('\'%s\' => %s::class', $type['key'], $type['classPath']);
        }, $types);
        $value = sprintf(
            'if(is_array($%1$s)) {' .
                '$typeObjects = [%2$s];' .
                '$this->%1$s = array_reduce(array_keys($typeObjects), function ($ret, $k) use ($typeObjects, $%1$s) {' .
                '$classPath = $typeObjects[$k];' .
                'return isset($%1$s[\'type\']) && $%1$s[\'type\'] === $k ? new $classPath($%1$s): $ret;' .
                '}, null);' .
                '} else {' .
                '$this->%1$s = $%1$s;' .
                '}',
            $property['name'],
            implode(', ', $typeKeys)
        );
        return $value;
    }

    protected function buildSetObjectPropertyBody(
        $property,
        $type,
        $baseNamespace,
        $isArray = false
    ) {
        if ($type === 'Format\\Component') {
            return $this->buildSetComponentPropertyBody($property, $isArray);
        }

        $isTyped = $property['typed'] ?? false;
        $relativeClassPath = $this->getRelativeClassPathFromObjectName($type, $baseNamespace);
        if ($property['name'] === 'contentDisplay') {
            $types = collect($property['type'])
                ->filter(function ($type) {
                    return preg_match('/Display$/', $type) === 1;
                })
                ->values()
                ->map(function ($type) use ($baseNamespace) {
                    return [
                        'key' => Str::snake(
                            preg_replace('/^Format\\\([A-Z][a-zA-Z]+)Display$/', '$1', $type)
                        ),
                        'class' => $this->getRelativeClassPathFromObjectName($type, $baseNamespace),
                    ];
                })
                ->map(function ($type, $index) {
                    return ($index === 0 ? 'if' : 'else if') .
                        ' (Utils::isAssociativeArray(%2$s) && %2$s[\'type\'] === \'' .
                        $type['key'] .
                        '\') { %1$s = new ' .
                        $type['class'] .
                        '(%2$s); }';
                })->join('');
            return sprintf(
                $types . 'else { %1$s = %2$s; }',
                sprintf('$this->%s', $property['name']),
                sprintf('$%s', $property['name'])
            );
        }
        return sprintf(
            $isTyped
                ? '%1$s = Utils::isAssociativeArray(%2$s) ? %3$s::createTyped(%2$s) : %2$s;'
                : '%1$s = Utils::isAssociativeArray(%2$s) ? new %3$s(%2$s) : %2$s;',
            $isArray ? '$array[$key]' : sprintf('$this->%s', $property['name']),
            $isArray ? '$item' : sprintf('$%s', $property['name']),
            $relativeClassPath
        );
    }

    protected function buildSetComponentPropertyBody($property, $isArray = false)
    {
        return sprintf(
            'if(%1$s instanceof Componentable) {' .
                '%2$s = %1$s->toComponent();' .
                '} else if (Utils::isAssociativeArray(%1$s)) {' .
                '%2$s = Component::createTyped(%1$s);' .
                '} else {' .
                '%2$s = %1$s;' .
                '}',
            $isArray ? '$item' : sprintf('$%s', $property['name']),
            $isArray ? '$array[$key]' : sprintf('$this->%s', $property['name'])
        );
    }

    protected function buildSetPropertyBody($property)
    {
        return sprintf('$this->%s = $%1$s;', $property['name']);
    }
}
