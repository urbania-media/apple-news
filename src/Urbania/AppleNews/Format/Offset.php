<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for setting an offset value to use with a text shadow.
 *
 * @see https://developer.apple.com/documentation/apple_news/offset
 */
class Offset implements \JsonSerializable
{
    /**
     * The x offset, as a value between -50.0 and 50.0. Implementation is
     * device dependent.
     * @var integer|float
     */
    protected $x;

    /**
     * The y offset, as a value between -50.0 and 50.0. Implementation is
     * device dependent.
     * @var integer|float
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
     * @return integer|float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the x
     * @param integer|float $x
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
     * @return integer|float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set the y
     * @param integer|float $y
     * @return $this
     */
    public function setY($y)
    {
        Assert::number($y);

        $this->y = $y;
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
        if (isset($this->x)) {
            $data['x'] = $this->x;
        }
        if (isset($this->y)) {
            $data['y'] = $this->y;
        }
        return $data;
    }
}
