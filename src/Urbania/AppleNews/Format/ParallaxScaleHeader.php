<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The scene that gives the impression of a parallax effect by zooming
 * out and scrolling slightly more slowly than the user’s action.
 *
 * @see https://developer.apple.com/documentation/apple_news/parallaxscaleheader
 */
class ParallaxScaleHeader extends Scene
{
    /**
     * Always parallax_scale for this scene type.
     * @var string
     */
    protected $type = 'parallax_scale';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
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
        $data = parent::toArray();
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
