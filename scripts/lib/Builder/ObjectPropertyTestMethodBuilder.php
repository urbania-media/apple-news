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
        $method = $this->buildTestMethod($property, $object);
        $providerMethod = $this->buildProviderMethod($property, $object);

        return [
            $method,
            $providerMethod
        ];
    }

    protected function buildTestMethod(array $property, array $object)
    {
        $name = $property['name'];
        $type = $property['type'];
        $readOnly = $property['read_only'] ?? false;

        $methodName = 'testProperty'.Utils::studlyCase($name);
        $method = new Method($methodName);

        $method->setVisibility('public');
        $method->addComment(sprintf('Test the property %s', $name));
        $method->addComment('@test');
        $method->addComment(sprintf('@dataProvider %sProvider', $name));
        $method->addComment(sprintf('@covers ::get%s', Utils::studlyCase($name)));
        if (!$readOnly) {
            $method->addComment(sprintf('@covers ::set%s', Utils::studlyCase($name)));
        }
        $method->addParameter('value');
        $method->setBody($this->buildBody($property, $object));
        return $method;
    }

    protected function buildProviderMethod(array $property, array $object)
    {
        $name = $property['name'];
        $methodName = $name.'Provider';
        $method = new Method($methodName);
        $method->setVisibility('public');
        $method->addComment(sprintf('Data provider for property %s', $name));
        $method->setBody($this->buildProviderBody($property, $object));

        return $method;
    }

    protected function buildProviderBody(array $property, array $object)
    {
        $values = (array)$this->getValuesFromProperty($property);
        $values = array_map(function ($value) {
            return sprintf(
                '[%s]',
                $value
            );
        }, $values);
        return sprintf(
            'return [%s];',
            implode(',', $values)
        );
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
            '$object = new %1$s();'.PHP_EOL.
            '$object->set%2$s($value);'.PHP_EOL.
            PHP_EOL.
            '$this->assertEquals($value, $object->get%2$s());',
            $objectClassName,
            Utils::studlyCase($property['name'])
        );
    }

    protected function buildReadOnlyBody(array $property, array $object)
    {
        $objectName = $object['name'];
        $objectClassName = $this->getClassBaseName($objectName);
        return sprintf(
            '$object = new %1$s();'.PHP_EOL.
            PHP_EOL.
            '$this->assertEquals($value, $object->get%2$s());',
            $objectClassName,
            Utils::studlyCase($property['name'])
        );
    }

    public function getValuesFromProperty($property)
    {
        $readOnly = $property['read_only'] ?? false;
        if ($readOnly && isset($property['value'])) {
            return $this->getSafeValue($property['value']);
        }
        $type = $property['type'];
        $mainType = is_array($type) ? $type[0] : current(explode(':', $type));
        switch ($mainType) {
            case 'SupportedUnits':
                return $this->getSafeValues(['1vh', 1.0, '1vmin']);
                break;
            case 'Code':
                return $this->getSafeValue('a code');
                break;
            case 'Status':
                return $this->getSafeValues([200, 400]);
                break;
            case 'Color':
                return $this->getSafeValues(['#fff', '#000']);
                break;
            case 'uuid':
                return $this->getSafeValue(Uuid::uuid1()->toString());
                break;
            case 'string':
                return $this->getSafeValue('a string');
                break;
            case 'uri':
                return $this->getSafeValues(['http://example.com', 'https://example.com']);
                break;
            case 'integer':
                return $this->getSafeValue(1);
                break;
            case 'enum':
                $values = $property['enum_values'];
                return $this->getSafeValues($values);
                break;
            case 'array':
                $itemType = last(explode(':', $type));
                if (preg_match('/^[A-Z]/', $itemType)) {
                    return sprintf(
                        '[new %s()]',
                        $this->getFullClassPath($itemType)
                    );
                }
                return $this->getSafeValues([[]]);
                break;
            case 'map':
                $itemType = last(explode(':', $type));
                if ($itemType !== $type) {
                    return sprintf('["test" => new %s()]', $this->getFullClassPath($itemType));
                }
                return '["test" => "value"]';
                break;
            case 'number':
                return $this->getSafeValues([1.1, 1]);
                break;
            case 'float':
                return $this->getSafeValue(1.1);
                break;
            case 'boolean':
                return $this->getSafeValues([true, false]);
                break;
            default:
                if (preg_match('/^[A-Z]/', $mainType)) {
                    return sprintf(
                        'new %s()',
                        $this->getFullClassPath($mainType)
                    );
                }
                break;
        }

        return 'null';
    }

    public function getSafeValues($values)
    {
        return array_map(function ($value) {
            return $this->getSafeValue($value);
        }, $values);
    }

    public function getSafeValue($value)
    {
        return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_LINE_TERMINATORS | JSON_UNESCAPED_UNICODE);
    }
}
