<?php

namespace Urbania\AppleNews\Scripts\Builder\Traits;

trait ClassUtils
{
    protected function getBaseNamespace()
    {
        return 'Urbania\AppleNews';
    }

    protected function getTestsBaseNamespace()
    {
        return 'Urbania\AppleNews\Tests';
    }

    protected function getUnitTestsBaseNamespace()
    {
        return 'Urbania\AppleNews\Tests\Unit';
    }

    protected function getNamespace($path = null)
    {
        if (is_null($path)) {
            return $this->getBaseNamespace();
        }
        $namespace = array_merge([
            $this->getBaseNamespace(),
        ], !is_array($path) ? [$path] : $path);
        return implode('\\', $namespace);
    }

    protected function getTestsNamespace($path = null)
    {
        if (is_null($path)) {
            return $this->getTestsBaseNamespace();
        }
        $namespace = array_merge([
            $this->getTestsBaseNamespace(),
        ], !is_array($path) ? [$path] : $path);
        return implode('\\', $namespace);
    }

    protected function getUnitTestsNamespace($path = null)
    {
        if (is_null($path)) {
            return $this->getUnitTestsBaseNamespace();
        }
        $namespace = array_merge([
            $this->getUnitTestsBaseNamespace(),
        ], !is_array($path) ? [$path] : $path);
        return implode('\\', $namespace);
    }

    protected function getClassNamespace($name)
    {
        $nameParts = explode('\\', $name);
        return $this->getNamespace(sizeof($nameParts) > 1 ? array_slice($nameParts, 0, -1) : []);
    }

    protected function getUnitTestClassNamespace($name)
    {
        $nameParts = explode('\\', $name);
        return $this->getUnitTestsNamespace(sizeof($nameParts) > 1 ? array_slice($nameParts, 0, -1) : []);
    }

    protected function getClassBaseName($name)
    {
        return last(explode('\\', $name));
    }

    protected function getTestClassBaseName($name)
    {
        return last(explode('\\', $name)).'Test';
    }

    protected function removeNamespaceFromClassPath($namespace, $name)
    {
        $pattern = '/^'.preg_quote(trim($namespace, '\\')).'/';
        if (preg_match($pattern, trim($name, '\\'))) {
            return ltrim(preg_replace($pattern, '', trim($name, '\\')), '\\');
        }
        return $name;
    }

    protected function getFullClassPath($name)
    {
        return '\\'.$this->getBaseNamespace().'\\'.$name;
    }

    protected function getUnitTestsFullClassPath($name)
    {
        return '\\'.$this->getUnitTestsBaseNamespace().'\\'.$name;
    }

    protected function getRelativeClassPathFromObjectName($objectName, $baseNamespace)
    {
        return $this->removeNamespaceFromClassPath(
            $baseNamespace,
            $this->getFullClassPath($objectName)
        );
    }

    protected function getTypeHint($type, $method = 'get')
    {
        $typeHints = [];

        $types = (array)$type;

        foreach ($types as $type) {
            $typeParts = explode(':', $type);
            $mainType = $typeParts[0];
            switch ($mainType) {
                case 'date-time':
                    $typeHints[] = '\Carbon\Carbon';
                    if ($method === 'set') {
                        $typeHints[] = 'string';
                    }
                    break;
                case 'enum':
                    $typeHints[] = $typeParts[1] ?? 'mixed';
                    break;
                case 'array':
                    $typeHints[] = $typeParts[1].'[]';
                    break;
                case 'map':
                    $typeHints[] = 'array';
                    break;
                case 'number':
                    $typeHints[] = 'integer';
                    $typeHints[] = 'float';
                    break;
                case 'SupportedUnits':
                case 'Color':
                case 'Code':
                case 'Status':
                case 'uuid':
                case 'uri':
                    $typeHints[] = 'string';
                    break;
                default:
                    if (preg_match('/^[A-Z]/', $mainType)) {
                        $typeHints[] = '\\'.$this->getNamespace($mainType);
                        if ($method === 'set') {
                            $typeHints[] = 'array';
                        }
                    } else {
                        $typeHints[] = $mainType;
                    }
                    break;
            }
        }

        $typeHints = array_unique($typeHints);
        usort($typeHints, function ($a, $b) {
            $aIsClass = preg_match('/^[A-Z]/', $a) === 1;
            $aIsObject = $aIsClass && preg_match('/\\\[A-Z]/', $a) === 1;
            $bIsClass = preg_match('/^[A-Z]/', $b) === 1;
            $bIsObject = $bIsClass && preg_match('/\\\[A-Z]/', $b) === 1;
            if ($aIsObject && !$bIsObject) {
                return -1;
            } elseif ($aIsClass && !$bIsClass) {
                return -1;
            } elseif ($aIsObject === $bIsObject || $aIsClass === $bIsClass) {
                return strcmp($a, $b);
            }
            return 1;
        });

        return implode('|', $typeHints);
    }

    protected function indent($line, $count = 1)
    {
        return str_repeat(' ', $count * 4).$line;
    }

    protected function hasDateTimeProperty($object)
    {
        return array_reduce($object['properties'] ?? [], function ($hasDateTime, $property) {
            return $hasDateTime || $property['type'] === 'date-time';
        }, false);
    }

    protected function hasComponentsProperty($object)
    {
        return array_reduce($object['properties'] ?? [], function ($hasComponents, $property) {
            return $hasComponents || $property['name'] === 'components';
        }, false);
    }
}
