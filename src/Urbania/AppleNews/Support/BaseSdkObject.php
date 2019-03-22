<?php

namespace Urbania\AppleNews\Support;

abstract class BaseSdkObject extends BaseObject
{
    /**
     * Merge data into this object
     * @param  BaseObject|array $data The data to merge
     * @return $this
     */
    public function merge($data)
    {
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            $studlyKey = Utils::studlyCase($key);
            $currentValue = $this->{'get'.$studlyKey}();
            if ($currentValue instanceof BaseSdkObject) {
                $currentValue->merge($value);
            } else {
                $this->{'set'.$studlyKey}(is_array($currentValue) ? array_merge(
                    $currentValue,
                    $value
                ) : $value);
            }
        }
        return $this;
    }

    /**
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        return new BaseObjectIterator($this, array_keys(get_object_vars($this)));
    }

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        $methodName = 'get' . Utils::studlyCase($name);
        if (method_exists($this, $methodName)) {
            return $this->{$methodName}();
        }

        $this->triggerPropertyError('Getting undefined property %s', $name);

        return null;
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        $methodName = 'set' . Utils::studlyCase($name);
        if (method_exists($this, $methodName)) {
            return $this->{$methodName}($value);
        }

        $this->triggerPropertyError('Setting undefined property %s', $name);

        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        $methodName = 'set' . Utils::studlyCase($name);
        if (method_exists($this, $methodName)) {
            return $this->{$methodName}(null);
        }

        $this->triggerPropertyError('Unsetting undefined property %s', $name);
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        return property_exists($this, $name) && isset($this->{$name});
    }

    /**
     * When cloning this object, we convert it to array and set every property
     */
    public function __clone()
    {
        $data = $this->toArray();
        foreach ($data as $key => $value) {
            $methodName = 'set' . Utils::studlyCase($key);
            $this->{$methodName}($value);
        }
    }
}
