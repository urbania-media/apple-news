<?php

namespace Urbania\AppleNews\Support;

abstract class BaseSdkObject extends BaseObject
{
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
        if (property_exists($this, $name)) {
            return isset($this->{$name});
        }

        $this->triggerPropertyError('Checking undefined property %s', $name);
        return false;
    }
}
