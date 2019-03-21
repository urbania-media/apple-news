<?php

namespace Urbania\AppleNews\Support;

use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Format\Component as ComponentObject;

class Component extends BaseObject implements Componentable
{
    protected function componentData()
    {
        return [];
    }

    public function toComponent()
    {
        return ComponentObject::createTyped($this->componentData());
    }

    /**
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        $component = $this->toComponent();
        return $component->getIterator();
    }

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        return $this->{$name};
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        $this->{$name} = $value;
        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        unset($this->{$name});
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        return isset($this->{$name});
    }

    /**
     * Get the document as array
     * @return array
     */
    public function toArray()
    {
        $component = $this->toComponent();
        return $component->toArray();
    }
}
