<?php

namespace Urbania\AppleNews;

use Carbon\Carbon;

/**
 * The object for specifying the color and location for a color stop in a
 * gradient.
 *
 * @see https://developer.apple.com/documentation/apple_news/colorstop
 */
class ColorStop
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
     * Get the location
     * @return integer|float
     */
    public function getLocation()
    {
        return $this->location;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'color' => is_object($this->color)
                ? $this->color->toArray()
                : $this->color,
            'location' => $this->location
        ];
    }
}
