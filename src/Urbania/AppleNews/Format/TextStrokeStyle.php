<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the stroke to use for an outline on text.
 *
 * @see https://developer.apple.com/documentation/apple_news/textstrokestyle
 */
class TextStrokeStyle
{
    /**
     * The stroke color.
     * @var string
     */
    protected $color;

    /**
     * Width of the stroke as a percentage relative to the font size.
     * @var integer
     */
    protected $width;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
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
     * Get the width
     * @return integer
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
     * Set the width
     * @param integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        Assert::integer($width);

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
            'width' => $this->width
        ];
    }
}
