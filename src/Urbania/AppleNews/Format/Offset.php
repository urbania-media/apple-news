<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for setting an offset value to use with a text shadow.
 *
 * @see https://developer.apple.com/documentation/apple_news/offset
 */
class Offset extends BaseSdkObject
{
    /**
     * The x offset, as a value between -50.0 and 50.0. Implementation is
     * device dependent.
     * @var float|integer
     */
    protected $x;

    /**
     * The y offset, as a value between -50.0 and 50.0. Implementation is
     * device dependent.
     * @var float|integer
     */
    protected $y;

    public function __construct(array $data = [])
    {
        if (isset($data['x'])) {
            $this->setX($data['x']);
        }

        if (isset($data['y'])) {
            $this->setY($data['y']);
        }
    }

    /**
     * Get the x
     * @return float|integer
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the x
     * @param float|integer $x
     * @return $this
     */
    public function setX($x)
    {
        Assert::number($x);

        $this->x = $x;
        return $this;
    }

    /**
     * Get the y
     * @return float|integer
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set the y
     * @param float|integer $y
     * @return $this
     */
    public function setY($y)
    {
        Assert::number($y);

        $this->y = $y;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->x)) {
            $data['x'] = $this->x;
        }
        if (isset($this->y)) {
            $data['y'] = $this->y;
        }
        return $data;
    }
}
