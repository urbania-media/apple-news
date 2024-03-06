<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for creating a text shadow.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/textshadow.json
 */
class TextShadow extends BaseSdkObject
{
    /**
     * The text shadow color.
     * @var string
     */
    protected $color;

    /**
     * The shadow’s radius as a value, in points, between  and 100.
     * @var integer|float
     */
    protected $radius;

    /**
     * The shadow’s offset.
     * @var \Urbania\AppleNews\Format\TextShadowOffset
     */
    protected $offset;

    /**
     * The opacity of the shadow as a value between  and 1.
     * @var float
     */
    protected $opacity;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
        }

        if (isset($data['radius'])) {
            $this->setRadius($data['radius']);
        }

        if (isset($data['offset'])) {
            $this->setOffset($data['offset']);
        }

        if (isset($data['opacity'])) {
            $this->setOpacity($data['opacity']);
        }
    }

    /**
     * Get the color
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the color
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        Assert::isColor($color);

        $this->color = $color;
        return $this;
    }

    /**
     * Get the offset
     * @return \Urbania\AppleNews\Format\TextShadowOffset
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set the offset
     * @param \Urbania\AppleNews\Format\TextShadowOffset|array $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        if (is_null($offset)) {
            $this->offset = null;
            return $this;
        }

        Assert::isSdkObject($offset, TextShadowOffset::class);

        $this->offset = Utils::isAssociativeArray($offset)
            ? new TextShadowOffset($offset)
            : $offset;
        return $this;
    }

    /**
     * Get the opacity
     * @return float
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set the opacity
     * @param float $opacity
     * @return $this
     */
    public function setOpacity($opacity)
    {
        if (is_null($opacity)) {
            $this->opacity = null;
            return $this;
        }

        Assert::float($opacity);

        $this->opacity = $opacity;
        return $this;
    }

    /**
     * Get the radius
     * @return integer|float
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Set the radius
     * @param integer|float $radius
     * @return $this
     */
    public function setRadius($radius)
    {
        Assert::number($radius);

        $this->radius = $radius;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->color)) {
            $data['color'] =
                $this->color instanceof Arrayable ? $this->color->toArray() : $this->color;
        }
        if (isset($this->radius)) {
            $data['radius'] = $this->radius;
        }
        if (isset($this->offset)) {
            $data['offset'] =
                $this->offset instanceof Arrayable ? $this->offset->toArray() : $this->offset;
        }
        if (isset($this->opacity)) {
            $data['opacity'] = $this->opacity;
        }
        return $data;
    }
}
