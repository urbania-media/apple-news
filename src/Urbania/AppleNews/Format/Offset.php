<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for setting an offset value to use with a text shadow.
 *
 * @see https://developer.apple.com/documentation/apple_news/offset
 */
class Offset
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
     * Get the y
     * @return integer|float
     */
    public function getY()
    {
        return $this->y;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'x' => $this->x,
            'y' => $this->y
        ];
    }
}
