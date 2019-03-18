<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Constant;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Utils;

class ObjectConstantsBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $constants)
    {
        $items = [];
        foreach ($constants as $item) {
            $constant = new Constant($item['name']);
            if (isset($item['value'])) {
                $constant->setValue($item['value']);
            }
            $items[] = $constant;
        }
        return $items;
    }
}
