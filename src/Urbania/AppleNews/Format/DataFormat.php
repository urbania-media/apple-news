<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all data format obejct types.
 *
 * @see https://developer.apple.com/documentation/apple_news/dataformat
 */
class DataFormat implements \JsonSerializable
{
    protected static $typeProperty = 'type';

    protected static $types = [
        'float' => 'FloatDataFormat',
        'image' => 'ImageDataFormat'
    ];

    /**
     * The type of format. This must be float for a FloatDataFormat object or
     * image for an ImageDataFormat object.
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
            $type = static::$types[$typeName] ?? null;
            if (!is_null($type)) {
                $namespace = implode(
                    '\\',
                    array_slice(explode('\\', static::class), 0, -1)
                );
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
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
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
