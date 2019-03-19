<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;

class ObjectJsonMethodsBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build()
    {
        $serializeMethod = new Method('jsonSerialize');
        $serializeMethod->setVisibility('public');
        $serializeMethod->setBody('return $this->toArray();');
        $serializeMethod->addComment('Convert the object into something JSON serializable.');
        $serializeMethod->addComment('@return array');

        $toJsonMethod = new Method('toJson');
        $toJsonMethod->setVisibility('public');
        $toJsonMethod->setBody('return json_encode($this->jsonSerialize(), $options);');
        $toJsonMethod->addComment('Convert the instance to JSON.');
        $toJsonMethod->addComment('@param  int  $options');
        $toJsonMethod->addComment('@return string');
        $toJsonMethod->addParameter('options', 0)
            ->setTypeHint('int');

        return [
            $serializeMethod,
            $toJsonMethod,
        ];
    }
}
