<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;
use Illuminate\Support\Str;

class ObjectArrayMethodsBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $property)
    {
        $members = [
            $this->buildAddItemsMethod($property),
            $this->buildAddItemMethod($property),
        ];

        return $members;
    }

    protected function buildAddItemsMethod($property)
    {
        $studlyName = Utils::studlyCase($property['name']);
        $method = new Method('add' . $studlyName);
        $method->setVisibility('public');

        $method->setBody(sprintf(
            'Assert::isArray($items);'.
            'return $this->set%s(!is_null($this->%2$s) ? array_merge($this->%2$s, $items) : $items);',
            $studlyName,
            $property['name']
        ));

        $method->addParameter('items');

        $method->addComment(sprintf('Add items to %s', $property['name']));
        $method->addComment('@param array $items');
        $method->addComment('@return $this');

        return $method;
    }

    protected function buildAddItemMethod($property)
    {
        $studlyName = Utils::studlyCase($property['name']);
        $method = new Method('add' . Str::singular($studlyName));
        $method->setVisibility('public');

        $method->setBody(sprintf(
            'return $this->set%s(!is_null($this->%2$s) ? array_merge($this->%2$s, [$item]) : [$item]);',
            $studlyName,
            $property['name']
        ));

        $method->addParameter('item');

        $method->addComment(sprintf('Add an item to %s', $property['name']));
        $itemType = last(explode(':', $property['type']));
        $method->addComment(sprintf('@param %s $item', $this->getTypeHint($itemType, 'set')));
        $method->addComment('@return $this');

        return $method;
    }
}
