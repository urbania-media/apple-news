<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\ClassType;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;
use ReflectionClass;

class ObjectClassBuilder
{
    use ClassUtils;

    protected $constantsBuilder;
    protected $typedBuilder;
    protected $propertiesBuilder;
    protected $constructMethodBuilder;
    protected $getMethodBuilder;
    protected $setMethodbuilder;
    protected $toArrayMethodBuilder;

    protected $baseExtends = 'Support\\BaseSdkObject';

    public function __construct()
    {
        $this->constantsBuilder = new ObjectConstantsBuilder();
        $this->typedBuilder = new ObjectTypedBuilder();
        $this->propertiesBuilder = new ObjectPropertiesBuilder();
        $this->constructMethodBuilder = new ObjectConstructMethodBuilder();
        $this->getMethodBuilder = new ObjectGetMethodBuilder();
        $this->setMethodBuilder = new ObjectSetMethodBuilder();
        $this->arrayMethodsBuilder = new ObjectArrayMethodsBuilder();
        $this->toArrayMethodBuilder = new ObjectToArrayMethodBuilder();
    }

    public function build(array $object)
    {
        $name = $object['name'];
        $fromClass = $object['from_class'] ?? null;
        $typed = $object['typed'] ?? null;
        $description = $object['description'] ?? null;
        $url = $object['url'] ?? null;
        $extends = $object['extends'] ?? null;
        $baseExtends = $object['base_extends'] ?? null;
        $properties = $object['properties'] ?? [];
        $constants = $object['constants'] ?? [];

        if (is_null($fromClass) && !is_null($typed)) {
            $fromClass = 'Typed';
        }

        $baseNamespace = $this->getClassNamespace($name);
        $baseClassName = $this->getClassBaseName($name);
        $methods = [];
        if (!is_null($fromClass)) {
            $class = ClassType::from($fromClass);
            $class->setName($baseClassName);
            $methods = $class->getMethods();
            $methods = $this->addMethodsBody($fromClass, $methods);
            $class->setMethods($methods);
        } else {
            $class = new ClassType($baseClassName);
        }

        if (!is_null($typed)) {
            $typedMembers = $this->buildTyped($typed);
            foreach ($typedMembers as $typedMember) {
                $class->addMember($typedMember);
            }
        }

        if (!empty($description)) {
            $lines = explode(PHP_EOL, wordwrap($description, 70, PHP_EOL));
            foreach ($lines as $line) {
                $class->addComment($line);
            }
        }

        if (!empty($url)) {
            if (!empty($description)) {
                $class->addComment('');
            }
            $class->addComment('@see ' . $url);
        }

        if (!is_null($extends)) {
            $class->setExtends($this->getNamespace($extends));
        } elseif (!is_null($baseExtends)) {
            $class->setExtends($this->getNamespace($baseExtends));
        } elseif (!is_null($this->baseExtends)) {
            $class->setExtends($this->getNamespace($this->baseExtends));
        }

        $propertiesMember = $this->buildProperties($properties, $baseClassName);
        foreach ($propertiesMember as $propertyMember) {
            $class->addMember($propertyMember);
        }

        $constants = $this->buildConstants($constants);
        foreach ($constants as $constant) {
            $class->addMember($constant);
        }

        $constructMethod = !isset($methods['__construct'])
            ? $this->buildConstructMethod($properties, $extends)
            : null;
        if (!is_null($constructMethod)) {
            $class->addMember($constructMethod);
        }

        $propertiesMethods = $this->buildPropertiesMethods(
            $properties,
            $baseNamespace
        );
        foreach ($propertiesMethods as $method) {
            $class->addMember($method);
        }

        $toArrayMethod = !isset($methods['toArray'])
            ? $this->buildToArrayMethod($properties, $extends)
            : null;
        if (!is_null($toArrayMethod)) {
            $class->addMember($toArrayMethod);
        }

        // $properties = $class->getProperties();
        // $sortedProperties = $this->sortMembers($properties);
        // $class->setProperties($sortedProperties);

        $methods = $class->getMethods();
        $sortedMethods = $this->sortMembers($methods);
        $class->setMethods($sortedMethods);

        return $class;
    }

    protected function addMethodsBody($fromClass, $methods)
    {
        $from = new ReflectionClass($fromClass);
        $filename = $from->getFilename();
        $lines = explode(PHP_EOL, file_get_contents($filename));
        foreach ($from->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() === $from->getName()) {
                $startLine = $method->getStartLine();
                $endLine = $method->getEndLine();
                $methodLines = array_slice(
                    $lines,
                    $startLine + 1,
                    $endLine - $startLine - 2
                );
                $methodLines = array_map(function ($line) {
                    return preg_replace('/^[\s]{4}/', '', $line);
                }, $methodLines);
                $methods[$method->getName()]->setBody(
                    implode(PHP_EOL, $methodLines)
                );
            }
        }
        return $methods;
    }

    protected function buildTyped($typed)
    {
        return $this->typedBuilder->build($typed);
    }

    protected function buildConstants(array $constants)
    {
        return $this->constantsBuilder->build($constants);
    }

    protected function buildProperties(array $properties, $baseClassName)
    {
        return $this->propertiesBuilder->build($properties, $baseClassName);
    }

    protected function buildConstructMethod(array $properties, $extends)
    {
        return $this->constructMethodBuilder->build($properties, $extends);
    }

    protected function buildPropertiesMethods($properties, $baseNamespace)
    {
        $methods = [];
        foreach ($properties as $property) {
            $methods[] = $this->buildPropertyGetMethod($property);
            $readOnly = $property['read_only'] ?? false;
            $isArray = is_string($property['type']) && current(explode(':', $property['type'])) === 'array';
            if (!$readOnly) {
                $methods[] = $this->buildPropertySetMethod(
                    $property,
                    $baseNamespace
                );
            }
            if ($isArray) {
                $methods = array_merge($methods, $this->buildPropertyArrayMethods(
                    $property
                ));
            }
        }
        return $methods;
    }

    protected function buildPropertyGetMethod($property)
    {
        return $this->getMethodBuilder->build($property);
    }

    protected function buildPropertySetMethod($property, $baseNamespace)
    {
        return $this->setMethodBuilder->build($property, $baseNamespace);
    }

    protected function buildPropertyArrayMethods($property)
    {
        return $this->arrayMethodsBuilder->build($property);
    }

    protected function buildToArrayMethod(array $properties, $extends)
    {
        return $this->toArrayMethodBuilder->build($properties, $extends);
    }

    protected function sortMembers($members)
    {
        $firstMethods = ['__construct', 'createTyped'];
        $lastMethods = ['toArray'];
        $names = array_keys($members);
        usort($names, function ($a, $b) use ($firstMethods, $lastMethods) {

            $aFirstMethodIndex = array_search($a, $firstMethods);
            $bFirstMethodIndex = array_search($b, $firstMethods);
            if ($aFirstMethodIndex !== false && $bFirstMethodIndex !== false) {
                return $aFirstMethodIndex > $bFirstMethodIndex;
            } elseif ($aFirstMethodIndex !== false) {
                return -1;
            } elseif ($bFirstMethodIndex !== false) {
                return 1;
            }

            $aLastMethodIndex = array_search($a, $lastMethods);
            $bLastMethodIndex = array_search($b, $lastMethods);
            if ($aLastMethodIndex !== false && $bLastMethodIndex !== false) {
                return $aLastMethodIndex > $bLastMethodIndex;
            } elseif ($aLastMethodIndex !== false) {
                return 1;
            } elseif ($bLastMethodIndex !== false) {
                return -1;
            }

            $aPropertyName = preg_replace('/^(get|set|add|remove)/', '', $a);
            $bPropertyName = preg_replace('/^(get|set|add|remove)/', '', $b);
            return $aPropertyName !== $bPropertyName
                ? strcmp($aPropertyName, $bPropertyName)
                : strcmp($a, $b);
        });
        return array_reduce(
            $names,
            function ($newMembers, $name) use ($members) {
                $newMembers[$name] = $members[$name];
                return $newMembers;
            },
            []
        );
    }
}
