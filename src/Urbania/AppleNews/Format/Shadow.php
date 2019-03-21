<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for creating a text shadow.
 *
 * @see https://developer.apple.com/documentation/apple_news/shadow
 */
class Shadow extends BaseSdkObject
{
    /**
     * The stroke color.
     * @var string
     */
    protected $color;

    /**
     * The shadow’s offset.
     * @var \Urbania\AppleNews\Format\Offset
     */
    protected $offset;

    /**
     * Opacity of the shadow as a value between 0 and 1.
     * @var integer|float
     */
    protected $opacity;

    /**
     * The shadow’s radius as a value between 0 and 100 in points.
     * @var integer|float
     */
    protected $radius;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
        }

        if (isset($data['offset'])) {
            $this->setOffset($data['offset']);
        }

        if (isset($data['opacity'])) {
            $this->setOpacity($data['opacity']);
        }

        if (isset($data['radius'])) {
            $this->setRadius($data['radius']);
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
     * @return \Urbania\AppleNews\Format\Offset
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set the offset
     * @param \Urbania\AppleNews\Format\Offset|array $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        if (is_null($offset)) {
            $this->offset = null;
            return $this;
        }

        Assert::isSdkObject($offset, Offset::class);

        $this->offset = is_array($offset) ? new Offset($offset) : $offset;
        return $this;
    }

    /**
     * Get the opacity
     * @return integer|float
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set the opacity
     * @param integer|float $opacity
     * @return $this
     */
    public function setOpacity($opacity)
    {
        if (is_null($opacity)) {
            $this->opacity = null;
            return $this;
        }

        Assert::number($opacity);

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
                $this->color instanceof Arrayable
                    ? $this->color->toArray()
                    : $this->color;
        }
        if (isset($this->offset)) {
            $data['offset'] =
                $this->offset instanceof Arrayable
                    ? $this->offset->toArray()
                    : $this->offset;
        }
        if (isset($this->opacity)) {
            $data['opacity'] = $this->opacity;
        }
        if (isset($this->radius)) {
            $data['radius'] = $this->radius;
        }
        return $data;
    }
}
