<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Property;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

class ObjectPropertiesBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $items)
    {
        $properties = [];
        foreach ($items as $item) {
            $property = new Property($item['name']);
            $property->setVisibility('protected');
            if (isset($item['description'])) {
                $lines = explode(PHP_EOL, wordwrap($item['description'], 70, PHP_EOL));
                foreach ($lines as $line) {
                    $property->addComment($line);
                }
            }
            $property->addComment('@var '.$this->getTypeHint($item['type']));
            if (isset($item['value'])) {
                $property->setValue($item['value']);
            }
            $properties[] = $property;
        }
        return $properties;
    }
}
