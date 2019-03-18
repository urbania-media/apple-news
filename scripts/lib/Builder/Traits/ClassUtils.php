<?php

namespace Urbania\AppleNews\Scripts\Builder\Traits;

trait ClassUtils
{
    protected function getBaseNamespace()
    {
        return 'Urbania\AppleNews';
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

    protected function getClassBaseName($name)
    {
        return last(explode('\\', $name));
    }

    protected function getClassNamespace($name)
    {
        $nameParts = explode('\\', $name);
        return $this->getNamespace(sizeof($nameParts) > 1 ? array_slice($nameParts, 0, -1) : []);
    }

    protected function removeNamespaceFromClassPath($namespace, $name)
    {
        return ltrim(preg_replace('/^'.preg_quote(rtrim($namespace, '\\')).'/', '', $name), '\\');
    }

    protected function getFullClassPath($name)
    {
        return $this->getBaseNamespace().'\\'.$name;
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
                case 'uuid':
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

        return implode('|', $typeHints);
    }

    protected function indent($line, $count = 1)
    {
        return str_repeat(' ', $count * 4).$line;
    }
}
