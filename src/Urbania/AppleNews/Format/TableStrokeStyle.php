<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the color, width, and style of a stroke in a
 * table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablestrokestyle
 */
class TableStrokeStyle
{
    /**
     * The stroke color.
     * @var string
     */
    protected $color;

    /**
     * The style of the stroke.
     * @var string
     */
    protected $style;

    /**
     * The width of the stroke line. Can be either an integer value in
     * points, or a string according to Specifying Measurements for
     * Components.
     * @var string|integer
     */
    protected $width;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }

        if (isset($data['width'])) {
            $this->setWidth($data['width']);
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
     * Get the style
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Get the width
     * @return string|integer
     */
    public function getWidth()
    {
        return $this->width;
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
     * Set the style
     * @param string $style
     * @return $this
     */
    public function setStyle($style)
    {
        Assert::string($style);

        $this->style = $style;
        return $this;
    }

    /**
     * Set the width
     * @param string|integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        Assert::isSupportedUnits($width);

        $this->width = $width;
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
            'style' => $this->style,
            'width' => is_object($this->width)
                ? $this->width->toArray()
                : $this->width
        ];
    }
}
