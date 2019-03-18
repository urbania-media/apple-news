<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for specifying the color and location for a color stop in a
 * gradient.
 *
 * @see https://developer.apple.com/documentation/apple_news/colorstop
 */
class ColorStop implements \JsonSerializable
{
    /**
     * The color of this color stop.
     * @var string
     */
    protected $color;

    /**
     * An optional location of the color stop within the gradient, as a
     * percentage of the gradient size. If location is omitted, the length of
     * the stop is calculated by first subtracting color stops with specified
     * locations from the full length, then equally distributing the
     * remaining length.
     * @var integer|float
     */
    protected $location;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
        }

        if (isset($data['location'])) {
            $this->setLocation($data['location']);
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
     * Get the location
     * @return integer|float
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the location
     * @param integer|float $location
     * @return $this
     */
    public function setLocation($location)
    {
        Assert::number($location);

        $this->location = $location;
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
        if (isset($this->location)) {
            $data['location'] = $this->location;
        }
        return $data;
    }
}
