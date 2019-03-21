<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Property;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

class ObjectPropertiesBuilder
{
    use ClassUtils;

    protected $defaultValues = [
        'Metadata' => [
            'generatorName' => 'Urbania/AppleNews',
            'generatorVersion' => '1.0'
        ]
    ];

    public function __construct()
    {
    }

    public function build(array $items, $baseClassName)
    {
        $properties = [];
        foreach ($items as $item) {
            $property = new Property($item['name']);
            $property->setVisibility('protected');
            if (isset($item['description'])) {
                $lines = explode(
                    PHP_EOL,
                    wordwrap($item['description'], 70, PHP_EOL)
                );
                foreach ($lines as $line) {
                    $property->addComment($line);
                }
            }
            $property->addComment('@var ' . $this->getTypeHint($item['type']));
            if (isset($item['value'])) {
                $property->setValue($item['value']);
            } elseif (isset($this->defaultValues[$baseClassName][$item['name']])) {
                $property->setValue(
                    $this->defaultValues[$baseClassName][$item['name']]
                );
            } elseif (is_string($item['type']) && current(explode(':', $item['type'])) === 'array') {
                $property->setValue([]);
            }
            $properties[] = $property;
        }
        return $properties;
    }
}
