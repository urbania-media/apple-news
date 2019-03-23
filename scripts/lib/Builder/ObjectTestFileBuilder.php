<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Property;
use Nette\PhpGenerator\Constant;
use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;

class ObjectTestFileBuilder
{
    use ClassUtils;

    protected $classBuilder;

    public function __construct()
    {
        $this->classBuilder = new ObjectTestClassBuilder();
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
        $namespaceName = $this->getUnitTestClassNamespace($object['name']);
        $namespace = $file->addNamespace($namespaceName);
        $namespace->addUse('Urbania\AppleNews\Tests\TestCase');
        $namespace->addUse($this->getFullClassPath($object['name']));
        return $namespace;
    }

    protected function buildClass(array $object)
    {
        return $this->classBuilder->build($object);
    }
}
