<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

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
            !is_null($extends) ? '$data = parent::toArray();' : '$data = [];'
        ];
        foreach ($properties as $property) {
            $lines[] = sprintf('if(isset($this->%s)) { %s }', $property['name'], $this->buildPropertyBody($property));
        }
        $lines[] = 'return $data;';

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
            case 'date-time':
                return sprintf(
                    '$data[\'%s\'] = !is_null($this->%1$s) ? $this->%1$s->toIso8601String() : null;',
                    $property['name']
                );
                break;
            case 'map':
            case 'array':
                $itemType = $typeParts[1] ?? null;
                if (!is_null($itemType) && preg_match('/^[A-Z]/', $itemType)) {
                    return sprintf(
                        '$data[\'%s\'] = !is_null($this->%1$s) ? ' .
                            'array_reduce(array_keys($this->%1$s), function ($items, $key) {' .
                            '$items[$key] = is_object($this->%1$s[$key]) ? $this->%1$s[$key]->toArray() : $this->%1$s[$key];' .
                            'return $items;' .
                            '}, []) : $this->%1$s;',
                        $property['name']
                    );
                } else {
                    return sprintf(
                        '$data[\'%s\'] = $this->%1$s;',
                        $property['name']
                    );
                }
                break;
            default:
                $mainType = $mainType === 'multiple' ? $property['type'][0] : $mainType;
                if (preg_match('/^[A-Z]/', $mainType)) {
                    return sprintf(
                        '$data[\'%s\'] = is_object($this->%1$s) ? $this->%1$s->toArray() : $this->%1$s;',
                        $property['name']
                    );
                } else {
                    return sprintf('$data[\'%s\'] = $this->%1$s;', $property['name']);
                }
                break;
        }
    }
}
