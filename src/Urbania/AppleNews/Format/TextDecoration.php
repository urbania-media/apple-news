<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining color and width for text underline or
 * strikethrough.
 *
 * @see https://developer.apple.com/documentation/apple_news/textdecoration
 */
class TextDecoration extends BaseSdkObject
{
    /**
     * Color of the stroke. If omitted, the content’s stroke color will be
     * used (from text color in case the stroke is for underline or
     * strikethrough).
     * @var string
     */
    protected $color;

    public function __construct(array $data = [])
    {
        if (isset($data['color'])) {
            $this->setColor($data['color']);
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
        return $data;
    }
}
