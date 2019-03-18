<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for creating a text shadow.
 *
 * @see https://developer.apple.com/documentation/apple_news/shadow
 */
class Shadow implements \JsonSerializable
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
        if (is_object($offset)) {
            Assert::isInstanceOf($offset, Offset::class);
        } else {
            Assert::isArray($offset);
        }

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
        if (isset($this->color)) {
            $data['color'] = is_object($this->color)
                ? $this->color->toArray()
                : $this->color;
        }
        if (isset($this->offset)) {
            $data['offset'] = is_object($this->offset)
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
