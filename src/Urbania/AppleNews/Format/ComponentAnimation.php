<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Properties shared by all the animations.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/componentanimation.json
 */
class ComponentAnimation extends BaseSdkObject
{
    protected static $typeProperty = 'type';

    protected static $types = [
        'appear' => 'AppearAnimation',
        'fade_in' => 'FadeInAnimation',
        'move_in' => 'MoveInAnimation',
        'scale_fade' => 'ScaleFadeAnimation',
    ];

    /**
     * The type of animation, for example, move_in for a Move-In Animation.
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
        Assert::oneOf($type, ['appear', 'fade_in', 'move_in', 'scale_fade']);

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
