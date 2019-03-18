<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Utils;

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

        $lines = [
            $this->buildPropertySetMethodBody($property, $baseNamespace),
            'return $this;'
        ];
        $method->setBody(implode(PHP_EOL, $lines));

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

    protected function buildPropertySetMethodBody($property, $baseNamespace)
    {
        $variableName = '$' . $property['name'];
        $lines = [];
        $lines[] =
            $this->buildPropertySetMethodAssertionBody($property, $baseNamespace) .
            PHP_EOL;
        $typeParts = explode(
            ':',
            is_array($property['type']) ? $property['type'][0] : $property['type']
        );
        $mainType = $typeParts[0];
        switch ($mainType) {
            case 'date-time':
                $lines[] = sprintf(
                    '$this->%s = is_string(%s) ? Carbon::parse(%s) : %s;',
                    $property['name'],
                    $variableName,
                    $variableName,
                    $variableName
                );
                break;
            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    $fullClassPath = $this->getFullClassPath($itemType);
                    $relativeClassPath = $this->removeNamespaceFromClassPath(
                        $baseNamespace,
                        $fullClassPath
                    );
                    $lines[] = '$items = [];';
                    $lines[] = sprintf('foreach (%s as $key => $item) {', $variableName);
                    $lines[] = $this->indent(sprintf(
                        '$items[$key] = is_array($item) ? new %s($item) : $item;',
                        $relativeClassPath,
                    ));
                    $lines[] = '}';
                    $lines[] = sprintf('$this->%s = $items;', $property['name']);
                } else {
                    $lines[] = sprintf(
                        '$this->%s = %s;',
                        $property['name'],
                        $variableName
                    );
                }
                break;
            case 'SupportedUnits':
            case 'Color':
                $lines[] = sprintf(
                    '$this->%s = %s;',
                    $property['name'],
                    $variableName
                );
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    $fullClassPath = $this->getFullClassPath($mainType);
                    $relativeClassPath = $this->removeNamespaceFromClassPath(
                        $baseNamespace,
                        $fullClassPath
                    );
                    $lines[] = sprintf(
                        '$this->%s = is_array(%s) ? new %s(%s) : %s;',
                        $property['name'],
                        $variableName,
                        $relativeClassPath,
                        $variableName,
                        $variableName
                    );
                } else {
                    $lines[] = sprintf(
                        '$this->%s = %s;',
                        $property['name'],
                        $variableName
                    );
                }
                break;
        }
        return implode(PHP_EOL, $lines);
    }

    protected function buildPropertySetMethodAssertionBody($property, $baseNamespace)
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
                $fullClassPath = $this->getFullClassPath($mainType);
                $relativeClassPath = $this->removeNamespaceFromClassPath(
                    $baseNamespace,
                    $fullClassPath
                );
                $lines[] = sprintf('if (is_object(%s)) {', $variableName);
                $lines[] = $this->indent(
                    sprintf(
                        'Assert::isInstanceOf(%s, %s::class);',
                        $variableName,
                        $relativeClassPath
                    )
                );
                $lines[] = sprintf('} elseif (!is_array(%s)) {', $variableName);
                $lines[] = $this->indent(
                    sprintf(
                        'Assert::' . $property['type'][1] . '(%s);',
                        $variableName
                    )
                );
                $lines[] = '}';
                break;

            case 'date-time':
                $lines[] = sprintf('Assert::isDate(%s);', $variableName);
                break;

            case 'SupportedUnits':
                $lines[] = sprintf('Assert::isSupportedUnits(%s);', $variableName);
                break;

            case 'Color':
                $lines[] = sprintf('Assert::isColor(%s);', $variableName);
                break;

            case 'uuid':
                $lines[] = sprintf('Assert::uuid(%s);', $variableName);
                break;

            case 'enum':
                if (isset($property['enum_constants'])) {
                    $values = array_map(function ($constant) {
                        return 'static::' . $constant;
                    }, $property['enum_constants']);
                    $line = [
                        'Assert::oneOf(',
                        $this->indent($variableName . ','),
                        $this->indent('[' . implode(', ', $values) . ']'),
                        ');'
                    ];
                    $lines[] = implode(PHP_EOL, $line);
                } elseif (isset($property['enum_values'])) {
                    $line = [
                        'Assert::oneOf(',
                        $this->indent($variableName . ','),
                        $this->indent(json_encode($property['enum_values'])),
                        ');'
                    ];
                    $lines[] = implode(PHP_EOL, $line);
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
                        'Assert::allIsInstanceOfOrArray(%s, %s::class);',
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
                    $fullClassPath = $this->getFullClassPath($mainType);
                    $relativeClassPath = $this->removeNamespaceFromClassPath(
                        $baseNamespace,
                        $fullClassPath
                    );
                    $lines[] = sprintf('if (is_object(%s)) {', $variableName);
                    $lines[] = $this->indent(
                        sprintf(
                            'Assert::isInstanceOf(%s, %s::class);',
                            $variableName,
                            $relativeClassPath
                        )
                    );
                    $lines[] = '} else {';
                    $lines[] = $this->indent(
                        sprintf('Assert::isArray(%s);', $variableName)
                    );
                    $lines[] = '}';
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
}
