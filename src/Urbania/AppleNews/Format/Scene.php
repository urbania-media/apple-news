<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * A combination of animations and behaviors to use in section and
 * chapter that have headers.
 *
 * @see https://developer.apple.com/documentation/apple_news/scene
 */
class Scene implements \JsonSerializable
{
    protected static $typeProperty = 'type';

    protected static $types = [
        'fading_sticky_header' => 'FadingStickyHeader',
        'parallax_scale' => 'ParallaxScaleHeader'
    ];

    /**
     * The type of scene. For example, parallax_scale for a Parallax Scale
     * Header scene or fading_sticky_header for a Fading Sticky Header.
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::string($type);

        $this->type = $type;
        return $this;
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
