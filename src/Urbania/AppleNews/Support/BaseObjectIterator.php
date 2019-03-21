<?php

namespace Urbania\AppleNews\Support;

use SeekableIterator;
use OutOfBoundsException;

class BaseObjectIterator implements SeekableIterator
{
    protected $position = 0;
    protected $object;
    protected $properties = [];

    public function __construct($object, array $properties)
    {
        $this->object = $object;
        $this->properties = $properties;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        $property = $this->properties[$this->position];
        return $this->object->{$property};
    }

    public function key()
    {
        return $this->properties[$this->position];
    }

    public function next()
    {
        ++$this->position;
    }

    public function seek($position)
    {
        if (!isset($this->properties[$position])) {
            throw new OutOfBoundsException(sprintf('Invalid position: %d', $position));
        }

        $this->position = $position;
    }

    public function valid()
    {
        return isset($this->properties[$this->position]);
    }
}
