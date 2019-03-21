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
            $type = $type[0] !== 'SupportedUnits' ? 'multiple' : $type[0];
        }
        $typeParts = explode(':', $type);
        $mainType = $typeParts[0];
        $variableName = '$' . $property['name'];
        $lines = [];
        switch ($mainType) {
            case 'multiple':
                $mainType = $property['type'][0];
                $secondType = $property['type'][1];
                $fullClassPath = $this->getFullClassPath($mainType);
                $relativeClassPath = $this->removeNamespaceFromClassPath(
                    $baseNamespace,
                    $fullClassPath
                );
                $lines[] = sprintf(
                    'if (is_object(%s)) {' .
                        'Assert::isSdkObject(%1$s, %s::class);' .
                        '} elseif (!is_array(%1$s)) {' .
                        'Assert::%s(%1$s);' .
                        '}',
                    $variableName,
                    $relativeClassPath,
                    $secondType
                );
                break;

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
                    $lines[] = sprintf('Assert::isMap(%s);', $variableName);
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
                } else {
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
                            $variableName,
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
                    $property['name'],
                );
                break;
            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    $lines[] = sprintf(
                        '$items = [];' .
                            'foreach ($%1$s as $key => $item) {' .
                            $this->buildSetObjectPropertyBody($property, $itemType, $baseNamespace, true).
                            '}' .
                            '$this->%1$s = $items;',
                        $property['name'],
                    );
                } else {
                    $lines[] = $this->buildSetPropertyBody($property);
                }
                break;
            case 'SupportedUnits':
            case 'Color':
            case 'Code':
                $lines[] = $this->buildSetPropertyBody($property);
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    $lines[] = $this->buildSetObjectPropertyBody($property, $mainType, $baseNamespace);
                } else {
                    $lines[] = $this->buildSetPropertyBody($property);
                }
                break;
        }
        return implode(PHP_EOL, $lines);
    }

    protected function buildSetObjectPropertyBody($property, $type, $baseNamespace, $isArray = false)
    {
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
            $isArray ? '$items[$key]' : sprintf('$this->%s', $property['name']),
            $isArray ? '$item' : sprintf('$%s', $property['name']),
            $relativeClassPath
        );
    }

    protected function buildSetComponentPropertyBody($property, $isArray = false)
    {
        return sprintf(
            'if(%1$s instanceof Componentable) {'.
                '%2$s = %1$s->toComponent();'.
            '} else if (is_array(%1$s)) {'.
                '%2$s = Component::createTyped(%1$s);'.
            '} else {'.
                '%2$s = %1$s;'.
            '}',
            $isArray ? '$item' : sprintf('$%s', $property['name']),
            $isArray ? '$items[$key]' : sprintf('$this->%s', $property['name'])
        );
    }

    protected function buildSetPropertyBody($property)
    {
        return sprintf(
            '$this->%s = $%1$s;',
            $property['name']
        );
    }
}
