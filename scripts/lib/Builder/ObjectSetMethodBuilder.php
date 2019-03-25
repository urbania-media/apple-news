<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

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
        $method->setVisibility('public');

        $isRequired = $property['required'] ?? false;
        $lines = array_filter(
            [
                !$isRequired
                    ? $this->buildUnsetBody($property) . PHP_EOL
                    : null,
                $this->buildAssertionBody($property, $baseNamespace) . PHP_EOL,
                $this->buildMethodBody($property, $baseNamespace),
                'return $this;'
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
            return $this->buildMultipleAssertionBody(
                $type,
                $property,
                $baseNamespace
            );
        }
        return $this->buildSingleAssertionBody(
            $type,
            $property,
            $baseNamespace
        );
    }

    protected function buildMultipleAssertionBody(
        $type,
        $property,
        $baseNamespace
    ) {
        if (sizeof($type) === 1) {
            return $this->buildSingleAssertionBody(
                $type,
                $property,
                $baseNamespace
            );
        } elseif (sizeof($type) === 2) {
            $firstIsObject = preg_match('/^[A-Z]/', $type[0]) === 1;
            $secondIsPrimitive = preg_match('/^[a-z]/', $type[1]) === 1;
            if ($type[0] === 'SupportedUnits' && $secondIsPrimitive) {
                return $this->buildSingleAssertionBody(
                    'SupportedUnits',
                    $property,
                    $baseNamespace
                );
            } elseif ($firstIsObject && $secondIsPrimitive) {
                return sprintf(
                    'if(is_object($%1$s) || is_array($%1$s)) { %2$s } else { %3$s }',
                    $property['name'],
                    $this->buildSingleAssertionBody(
                        $type[0],
                        $property,
                        $baseNamespace
                    ),
                    $this->buildSingleAssertionBody(
                        $type[1],
                        $property,
                        $baseNamespace
                    )
                );
            } else {
                $relativeClassPaths = array_map(function ($type) use ($baseNamespace) {
                    $fullClassPath = $this->getFullClassPath($type);
                    return $this->removeNamespaceFromClassPath(
                        $baseNamespace,
                        $fullClassPath
                    ) . '::class';
                }, $type);

                return sprintf(
                    'Assert::isSdkObjects($%s, [%s]);',
                    $property['name'],
                    implode(',', $relativeClassPaths)
                );
            }
        } elseif (in_array('SupportedUnits', $type)) {
            $objectType = array_reduce(
                $type,
                function ($objectType, $type) {
                    if (
                        $type !== 'SupportedUnits' &&
                        preg_match('/^[A-Z]/', $type) === 1
                    ) {
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
                    $this->buildSingleAssertionBody(
                        $objectType,
                        $property,
                        $baseNamespace
                    ),
                    $this->buildSingleAssertionBody(
                        'SupportedUnits',
                        $property,
                        $baseNamespace
                    )
                )
                : $this->buildSingleAssertionBody(
                    'SupportedUnits',
                    $property,
                    $baseNamespace
                );
        }
        return '';
    }

    protected function buildSingleAssertionBody(
        $type,
        $property,
        $baseNamespace
    ) {
        $typeParts = explode(':', $type);
        $mainType = $typeParts[0];
        $variableName = '$' . $property['name'];
        $lines = [];
        switch ($mainType) {
            case 'date-time':
                $lines[] = sprintf('Assert::isDate(%s);', $variableName);
                break;

            case 'SupportedUnits':
                $lines[] = sprintf(
                    'Assert::isSupportedUnits(%s);',
                    $variableName
                );
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
                    $fullClassPath = $this->getFullClassPath($itemType);
                    $relativeClassPath = $this->removeNamespaceFromClassPath(
                        $baseNamespace,
                        $fullClassPath
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
                        $lines[] = sprintf(
                            'Assert::isComponent(%s);',
                            $variableName
                        );
                    } else {
                        $fullClassPath = $this->getFullClassPath($mainType);
                        $relativeClassPath = $this->removeNamespaceFromClassPath(
                            $baseNamespace,
                            $fullClassPath
                        );
                        $lines[] = sprintf(
                            'Assert::isSdkObject(%s, %s::class);',
                            $variableName,
                            $relativeClassPath
                        );
                    }
                } else {
                    $lines[] = sprintf(
                        'Assert::%s(%s);',
                        $mainType,
                        $variableName
                    );
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
            is_array($property['type'])
                ? $property['type'][0]
                : $property['type']
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
                        '$this->%1$s = array_reduce(array_keys($%1$s), function ($array, $key) use ($%1$s) {' .
                            '$item = $%1$s[$key];' .
                            $this->buildSetObjectPropertyBody(
                                $property,
                                $itemType,
                                $baseNamespace,
                                true
                            ) .
                            'return $array;' .
                            '}, []);',
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
                if (is_array($property['type']) &&
                    sizeof($property['type']) === 2 &&
                    preg_match('/^Format\\\(.*?)Display$/', $property['type'][0]) === 1 &&
                    preg_match('/^Format\\\(.*?)Display$/', $property['type'][1]) === 1
                ) {
                    $lines[] = $this->buildSetDisplayObjectPropertyBody(
                        $property,
                        $baseNamespace
                    );
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

    protected function buildSetDisplayObjectPropertyBody($property, $baseNamespace)
    {
        $firstType = $property['type'][0];
        $secondType = $property['type'][1];
        preg_match('/^Format\\\(.*?)Display$/', $firstType, $matches);
        $firstTypeValue = preg_replace('/\s+/u', '', ucwords($matches[1]));
        $firstTypeValue = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1_', $firstTypeValue), 'utf-8');
        $firstFullClassPath = $this->getFullClassPath($firstType);
        $firstRelativeClassPath = $this->removeNamespaceFromClassPath(
            $baseNamespace,
            $firstFullClassPath
        );
        $secondFullClassPath = $this->getFullClassPath($secondType);
        $secondRelativeClassPath = $this->removeNamespaceFromClassPath(
            $baseNamespace,
            $secondFullClassPath
        );
        return sprintf(
            'if(is_array($%1$s)) {'.
                '$this->%1$s = !isset($%1$s[\'type\']) || $%1$s[\'type\'] === \'%2$s\' ? new %3$s($%1$s) : new %4$s($%1$s);'.
            '} else {'.
                '$this->%1$s = $%1$s;'.
            '}',
            $property['name'],
            $firstTypeValue,
            $firstRelativeClassPath,
            $secondRelativeClassPath
        );
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
        $fullClassPath = $this->getFullClassPath($type);
        $relativeClassPath = $this->removeNamespaceFromClassPath(
            $baseNamespace,
            $fullClassPath
        );
        return sprintf(
            $isTyped
                ? '%1$s = is_array(%2$s) ? %3$s::createTyped(%2$s) : %2$s;'
                : '%1$s = is_array(%2$s) ? new %3$s(%2$s) : %2$s;',
            $isArray ? '$array[$key]' : sprintf('$this->%s', $property['name']),
            $isArray ? '$item' : sprintf('$%s', $property['name']),
            $relativeClassPath
        );
    }

    protected function buildSetComponentPropertyBody(
        $property,
        $isArray = false
    ) {
        return sprintf(
            'if(%1$s instanceof Componentable) {' .
                '%2$s = %1$s->toComponent();' .
                '} else if (is_array(%1$s)) {' .
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
