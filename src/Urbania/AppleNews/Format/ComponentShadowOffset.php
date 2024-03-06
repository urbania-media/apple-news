<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for setting an offset value to use with a component shadow.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/componentshadowoffset.json
 */
class ComponentShadowOffset extends BaseSdkObject
{
    /**
     * The x offset, as a value in . Implementation is device dependent.
     * @var string|integer|float
     */
    protected $x;

    /**
     * The y offset, as a value in . Implementation is device dependent.
     * @var string|integer|float
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
     * @return string|integer|float
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the x
     * @param string|integer|float $x
     * @return $this
     */
    public function setX($x)
    {
        if (is_null($x)) {
            $this->x = null;
            return $this;
        }

        Assert::isSupportedUnits($x);

        $this->x = $x;
        return $this;
    }

    /**
     * Get the y
     * @return string|integer|float
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set the y
     * @param string|integer|float $y
     * @return $this
     */
    public function setY($y)
    {
        if (is_null($y)) {
            $this->y = null;
            return $this;
        }

        Assert::isSupportedUnits($y);

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
            $data['x'] = $this->x instanceof Arrayable ? $this->x->toArray() : $this->x;
        }
        if (isset($this->y)) {
            $data['y'] = $this->y instanceof Arrayable ? $this->y->toArray() : $this->y;
        }
        return $data;
    }
}
