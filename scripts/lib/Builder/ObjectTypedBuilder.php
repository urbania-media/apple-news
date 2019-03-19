<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Property;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

class ObjectTypedBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $typed)
    {
        $propertyName = $typed['property'] ?? 'type';
        $types = $typed['types'] ?? [];

        $typeProperty = new Property('typeProperty');
        $typeProperty->setVisibility('protected')
            ->setStatic()
            ->setValue($propertyName);

        $typesProperty = new Property('types');
        $typesProperty->setVisibility('protected')
            ->setStatic()
            ->setValue($types);

        return [
            $typeProperty,
            $typesProperty
        ];
    }
}
