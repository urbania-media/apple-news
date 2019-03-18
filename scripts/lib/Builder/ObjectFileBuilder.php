<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Property;
use Nette\PhpGenerator\Constant;
use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;

class ObjectFileBuilder
{
    use ClassUtils;

    protected $classBuilder;

    public function __construct()
    {
        $this->classBuilder = new ObjectClassBuilder();
    }

    public function build(array $object)
    {
        $file = new PhpFile();

        $namespace = $this->buildNamespace($file, $object);
        $class = $this->buildClass($object);
        $namespace->add($class);

        return $file;
    }

    protected function buildNamespace(PhpFile $file, array $object)
    {
        $namespaceName = $this->getClassNamespace($object['name']);
        $namespace = $file->addNamespace($namespaceName);
        $namespace->addUse('Carbon\Carbon');
        $namespace->addUse('Urbania\AppleNews\Assert');
        return $namespace;
    }

    protected function buildClass(array $object)
    {
        return $this->classBuilder->build($object);
    }
}
