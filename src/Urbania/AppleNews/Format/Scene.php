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
class Scene
{
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->type
        ];
    }
}
