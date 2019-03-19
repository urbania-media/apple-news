<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

class ObjectGetMethodBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $property)
    {
        $studlyName = Utils::studlyCase($property['name']);
        $method = new Method('get'.$studlyName);
        $method->setVisibility('public');
        $method->setBody('return $this->'.$property['name'].';');
        $method->addComment('Get the '.$property['name']);
        $method->addComment('@return '.$this->getTypeHint($property['type']));
        return $method;
    }
}
