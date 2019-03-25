<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The behavior whereby a component moves at a speed different from the
 * scroll speed.
 *
 * @see https://developer.apple.com/documentation/apple_news/parallax
 */
class Parallax extends Behavior
{
    /**
     * Always parallax for this behavior.
     * @var string
     */
    protected $type = 'parallax';

    /**
     * The speed of the component, as a factor of the scroll speed.The value
     * of factor must be between 0.5 and 2.0. Values outside this range will
     * be reset to the minimum or maximum value.
     * @var float|integer
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
     * @return float|integer
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set the factor
     * @param float|integer $factor
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
