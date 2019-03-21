<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining the color, width, and style of a stroke in a
 * table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablestrokestyle
 */
class TableStrokeStyle extends BaseSdkObject
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
     * Set the color
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        if (is_null($color)) {
            $this->color = null;
            return $this;
        }

        Assert::isColor($color);

        $this->color = $color;
        return $this;
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
     * Set the style
     * @param string $style
     * @return $this
     */
    public function setStyle($style)
    {
        if (is_null($style)) {
            $this->style = null;
            return $this;
        }

        Assert::string($style);

        $this->style = $style;
        return $this;
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
     * Set the width
     * @param string|integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        if (is_null($width)) {
            $this->width = null;
            return $this;
        }

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
        $data = [];
        if (isset($this->color)) {
            $data['color'] =
                $this->color instanceof Arrayable
                    ? $this->color->toArray()
                    : $this->color;
        }
        if (isset($this->style)) {
            $data['style'] = $this->style;
        }
        if (isset($this->width)) {
            $data['width'] =
                $this->width instanceof Arrayable
                    ? $this->width->toArray()
                    : $this->width;
        }
        return $data;
    }
}
