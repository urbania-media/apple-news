<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\ClassType;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;
use ReflectionClass;

class ObjectTestClassBuilder
{
    use ClassUtils;

    protected $propertyTestMethodBuilder;

    public function __construct()
    {
        $this->propertyTestMethodBuilder = new ObjectPropertyTestMethodBuilder();
    }

    public function build(array $object)
    {
        $name = $object['name'];
        $baseNamespace = $this->getUnitTestClassNamespace($name);
        $baseClassName = $this->getTestClassBaseName($name);

        $class = new ClassType($baseClassName);
        $class->setExtends('Urbania\AppleNews\Tests\TestCase');
        $class->addComment(sprintf('@coversDefaultClass %s', $this->getFullClassPath($name)));

        $members = $this->buildPropertiesTest($object);
        foreach ($members as $member) {
            $class->addMember($member);
        }

        return $class;
    }

    protected function buildPropertiesTest(array $object)
    {
        $properties = $object['properties'] ?? [];
        return array_map(function ($property) use ($object) {
            return $this->propertyTestMethodBuilder->build($property, $object);
        }, $properties);
    }
}
