<?php

class Typed
{
    protected static $typeProperty;

    protected static $types;

    public static function createTyped(array $data)
    {
        if (isset($data[static::$typeProperty])) {
            $typeName = $data[static::$typeProperty];
            $type = static::$types[$typeName] ?? null;
            if (!is_null($type)) {
                $namespace = implode('\\', array_slice(explode('\\', static::class), 0, -1));
                $typeClass = $namespace.'\\'.$type;
                return new $typeClass($data);
            }
        }

        return new static($data);
    }
}
