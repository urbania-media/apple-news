<?php

namespace Urbania\AppleNews\Scripts\Builder;

use Nette\PhpGenerator\Method;
use Urbania\AppleNews\Scripts\Builder\Traits\ClassUtils;
use Urbania\AppleNews\Support\Utils;
use Ramsey\Uuid\Uuid;

class ObjectPropertyTestMethodBuilder
{
    use ClassUtils;

    public function build(array $property, array $object)
    {
        $name = $property['name'];
        $type = $property['type'];
        $readOnly = $property['read_only'] ?? false;

        $methodName = 'testPropery'.Utils::studlyCase($property['name']);
        $method = new Method($methodName);

        $method->setVisibility('public');
        $method->addComment(sprintf('Test the property %s', $name));
        $method->addComment('@test');
        $method->addComment(sprintf('@covers ::get%s', Utils::studlyCase($property['name'])));
        if (!$readOnly) {
            $method->addComment(sprintf('@covers ::set%s', Utils::studlyCase($property['name'])));
        }
        $method->setBody($this->buildBody($property, $object));

        return $method;
    }

    protected function buildBody(array $property, array $object)
    {
        $name = $property['name'];
        $objectName = $object['name'];
        $objectClassName = $this->getClassBaseName($objectName);
        $readOnly = $property['read_only'] ?? false;
        if ($readOnly) {
            return $this->buildReadOnlyBody($property, $object);
        }
        return sprintf(
            '$value = %1$s;'.PHP_EOL.
            '$object = new %2$s();'.PHP_EOL.
            '$object->set%3$s($value);'.PHP_EOL.
            PHP_EOL.
            '$this->assertEquals($value, $object->get%3$s());',
            $this->getValueFromProperty($property),
            $objectClassName,
            Utils::studlyCase($property['name'])
        );
    }

    protected function buildReadOnlyBody(array $property, array $object)
    {
        $objectName = $object['name'];
        $objectClassName = $this->getClassBaseName($objectName);
        return sprintf(
            '$value = %1$s;'.PHP_EOL.
            '$object = new %2$s();'.PHP_EOL.
            PHP_EOL.
            '$this->assertEquals($value, $object->get%3$s());',
            $this->getSaveValue($property['value']),
            $objectClassName,
            Utils::studlyCase($property['name'])
        );
    }

    public function getValueFromProperty($property)
    {
        $type = $property['type'];
        $mainType = is_array($type) ? $type[0] : current(explode(':', $type));
        switch ($mainType) {
            case 'SupportedUnits':
                return $this->getSaveValue('1vh');
                break;
            case 'Color':
                return $this->getSaveValue('#fff');
                break;
            case 'uuid':
                return $this->getSaveValue(Uuid::uuid1()->toString());
                break;
            case 'string':
                return $this->getSaveValue('a string');
                break;
            case 'uri':
                return $this->getSaveValue('http://example.com');
                break;
            case 'integer':
                return $this->getSaveValue(1);
                break;
            case 'enum':
                $values = $property['enum_values'];
                return $this->getSaveValue($values[array_rand($values)]);
                break;
            case 'array':
                return $this->getSaveValue([]);
                break;
            case 'map':
                $itemType = last(explode(':', $type));
                return sprintf('["test" => new %s()]', $this->getFullClassPath($itemType));
                break;
            case 'number':
            case 'float':
                return $this->getSaveValue(1.0);
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    return sprintf(
                        'new %s();',
                        $this->getFullClassPath($mainType)
                    );
                }
                break;
        }

        return 'null';
    }

    public function getSaveValue($value)
    {
        return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_UNICODE);
    }
}
