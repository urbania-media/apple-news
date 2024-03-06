<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Properties shared by all data format obejct types.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/dataformat.json
 */
class DataFormat extends BaseSdkObject
{
    protected static $typeProperty = 'type';
    protected static $types = ['float' => 'FloatDataFormat', 'image' => 'ImageDataFormat'];

    /**
     * The type of format. This must be float for a  object or image for an
     * object.
     * @var string
     */
    protected $type = 'float';

    public function __construct(array $data = [])
    {
    }

    public static function createTyped(array $data)
    {
        if (isset($data[static::$typeProperty])) {
            $typeName = $data[static::$typeProperty];
            $type = isset(static::$types[$typeName]) ? static::$types[$typeName] : null;
            if (!is_null($type)) {
                $namespace = implode('\\', array_slice(explode('\\', static::class), 0, -1));
                $typeClass = $namespace . '\\' . $type;
                return new $typeClass($data);
            }
        }

        return new static($data);
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
