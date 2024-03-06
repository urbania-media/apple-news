<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The behavior whereby a component moves at a speed different from the
 * scroll speed.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/parallax.json
 */
class Parallax extends Behavior
{
    /**
     * This behavior always has the type parallax.
     * @var string
     */
    protected $type = 'parallax';

    /**
     * The speed of the component, as a factor of the scroll speed.The value
     * of factor must be between 0.5 and 2.0. Values outside this range will
     * be reset to the minimum or maximum value.
     * The parallax factor 1.0 is equal to the scroll speed.
     * A factor lower than 1.0 makes the component move more slowly than the
     * scrolling speed.
     * A factor higher than 1.0 makes the component move more quickly than
     * the scrolling speed.
     * @var integer|float
     */
    protected $factor;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['factor'])) {
            $this->setFactor($data['factor']);
        }
    }

    /**
     * Get the factor
     * @return integer|float
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set the factor
     * @param integer|float $factor
     * @return $this
     */
    public function setFactor($factor)
    {
        if (is_null($factor)) {
            $this->factor = null;
            return $this;
        }

        Assert::number($factor);

        $this->factor = $factor;
        return $this;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->factor)) {
            $data['factor'] = $this->factor;
        }
        return $data;
    }
}
