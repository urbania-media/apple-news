<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Utils;

class ObjectToArrayMethodBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $properties, $extends = null)
    {
        $method = new Method('toArray');
        $method->setVisibility('public');
        $method->setBody($this->buildBody($properties, $extends));
        $method->addComment('Get the object as array');
        $method->addComment('@return array');
        return $method;
    }

    protected function buildBody(array $properties, $extends)
    {
        $lines = [
            !is_null($extends)
                ? 'return array_merge(parent::toArray(), ['
                : 'return ['
        ];

        foreach ($properties as $property) {
            $bodyLines = (array) $this->buildPropertyBody($property);
            $lastIndex = sizeof($bodyLines) - 1;
            foreach ($bodyLines as $index => $bodyLine) {
                $lines[] =
                    $this->indent($bodyLine . ($index === $lastIndex ? ',' : ''));
            }
        }

        $lines[] = !is_null($extends) ? ']);' : '];';

        return implode(PHP_EOL, $lines);
    }

    protected function buildPropertyBody($property)
    {
        $typeParts = explode(
            ':',
            is_array($property['type']) ? 'multiple' : $property['type']
        );
        $mainType = $typeParts[0];
        switch ($mainType) {
            case 'multiple':
                $mainType = $property['type'][0];
                if (preg_match('/^[A-Z]/', $mainType)) {
                    return sprintf(
                        '\'%s\' => is_object($this->%s) ? $this->%s->toArray() : $this->%s',
                        $property['name'],
                        $property['name'],
                        $property['name'],
                        $property['name']
                    );
                } else {
                    return sprintf(
                        '\'%s\' => $this->%s',
                        $property['name'],
                        $property['name']
                    );
                }
                break;
            case 'date-time':
                return sprintf(
                    '\'%s\' => !is_null($this->%s) ? $this->%s->toIso8601String() : null',
                    $property['name'],
                    $property['name'],
                    $property['name']
                );
                break;
            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    $lines = [];
                    $lines[] = sprintf(
                        '\'%s\' => !is_null($this->%s) ? array_reduce(array_keys($this->%s), function ($items, $key) {',
                        $property['name'],
                        $property['name'],
                        $property['name']
                    );
                    $lines[] = $this->indent(
                        sprintf(
                            '$items[$key] = is_object($this->%s[$key]) ? $this->%s[$key]->toArray() : $this->%s[$key];',
                            $property['name'],
                            $property['name'],
                            $property['name']
                        )
                    );
                    $lines[] = $this->indent('return $items;');
                    $lines[] = sprintf('}, []) : $this->%s', $property['name']);
                    return $lines;
                } else {
                    return sprintf(
                        '\'%s\' => $this->%s ?? []',
                        $property['name'],
                        $property['name']
                    );
                }
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    return sprintf(
                        '\'%s\' => is_object($this->%s) ? $this->%s->toArray() : $this->%s',
                        $property['name'],
                        $property['name'],
                        $property['name'],
                        $property['name']
                    );
                } else {
                    return sprintf(
                        '\'%s\' => $this->%s',
                        $property['name'],
                        $property['name']
                    );
                }
                break;
        }
    }
}
