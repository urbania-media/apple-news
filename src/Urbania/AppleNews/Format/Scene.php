<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * A combination of animations and behaviors to use in sections and
 * chapters that have headers.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/scene.json
 */
class Scene extends BaseSdkObject
{
    protected static $typeProperty = 'type';
    protected static $types = [
        'fading_sticky_header' => 'FadingStickyHeader',
        'parallax_scale' => 'ParallaxScaleHeader',
    ];

    /**
     * The type of scene. For example, parallax_scale for a Parallax Scale
     * Header scene or fading_sticky_header for a Fading Sticky Header.
     * Version 1.0
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
        Assert::oneOf($type, ['fading_sticky_header', 'parallax_scale']);

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
