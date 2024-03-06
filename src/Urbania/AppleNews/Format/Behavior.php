<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Properties shared by all the behaviors you can use to affect how
 * components react to device motion and scrolling.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/behavior.json
 */
class Behavior extends BaseSdkObject
{
    protected static $typeProperty = 'type';

    protected static $types = [
        'background_motion' => 'BackgroundMotion',
        'background_parallax' => 'BackgroundParallax',
        'motion' => 'Motion',
        'parallax' => 'Parallax',
        'springy' => 'Springy',
    ];

    /**
     * The type of behavior, for example, parallax for a Parallax behavior.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::oneOf($type, [
            'background_motion',
            'background_parallax',
            'motion',
            'parallax',
            'springy',
        ]);

        $this->type = $type;
        return $this;
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
