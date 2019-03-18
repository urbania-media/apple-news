<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Utils;

class ObjectConstructMethodBuilder
{
    use ClassUtils;

    public function __construct()
    {
    }

    public function build(array $properties, $extends = null)
    {
        $method = new Method('__construct');
        $method->setVisibility('public');
        $method->setBody($this->buildBody($extends, $properties));

        $method->addParameter('data', [])
            ->setTypeHint('array');

        return $method;
    }

    protected function buildBody($extends, $properties)
    {
        $lines = [];

        if (!is_null($extends)) {
            $lines[] = 'parent::__construct($data);';
        }

        foreach ($properties as $property) {
            $readOnly = $property['read_only'] ?? false;
            if ($readOnly) {
                continue;
            }
            $studlyName = Utils::studlyCase($property['name']);
            $line = [];
            $line[] = 'if (isset($data[\''.$property['name'].'\'])) {';
            $line[] = '    $this->set'.$studlyName.'($data[\''.$property['name'].'\']);';
            $line[] = '}';
            $lines[] = implode(PHP_EOL, $line);
        }
        return implode(PHP_EOL.PHP_EOL, $lines);
    }
}
