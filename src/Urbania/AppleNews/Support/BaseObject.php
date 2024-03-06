<?php

namespace Urbania\AppleNews\Support;

use ArrayAccess;
use JsonSerializable;
use IteratorAggregate;
use ReflectionClass;
use ReflectionProperty;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

abstract class BaseObject implements
    ArrayAccess,
    Arrayable,
    Jsonable,
    JsonSerializable,
    IteratorAggregate
{
    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    abstract protected function propertyGet($name);

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    abstract protected function propertySet($name, $value);

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    abstract protected function propertyUnset($name);

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    abstract protected function propertyExists($name);

    /**
     * Merge an object
     * @param  mixed $object The object to merge
     * @return $this
     */
    // abstract protected function merge($object);

    /**
     * Trigger a property error
     * @param  string $message The error message
     * @param  string $name    The name of the property
     * @return void
     */
    protected function triggerPropertyError($message, $name)
    {
        $trace = debug_backtrace();
        trigger_error(
            sprintf(
                '%s in %s on line %d',
                sprintf($message, $name),
                $trace[0]['file'],
                $trace[0]['line']
            ),
            E_USER_NOTICE
        );
    }

    /**
     * Determine if the given offset exists.
     *
     * @param  string  $offset
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->propertyExists($key);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  string  $offset
     * @return mixed
     */
    public function offsetGet(mixed $key): mixed
    {
        return $this->propertyGet($key);
    }

    /**
     * Set the value at the given offset.
     *
     * @param  string  $offset
     * @param  mixed   $value
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        $this->propertySet($key, $value);
    }

    /**
     * Unset the value at the given offset.
     *
     * @param  string  $offset
     * @return void
     */
    public function offsetUnset($key): void
    {
        $this->propertyUnset($key);
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->propertyGet($key);
    }

    /**
     * Dynamically set the value of an attribute.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->propertySet($key, $value);
    }

    /**
     * Dynamically check if an attribute is set.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->propertyExists($key);
    }

    /**
     * Dynamically unset an attribute.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        $this->propertyUnset($key);
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get the object as array
     * @return array
     */
    abstract public function toArray();
}
