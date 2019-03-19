<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for displaying a linear gradient as a component background.
 *
 * @see https://developer.apple.com/documentation/apple_news/lineargradientfill
 */
class LinearGradientFill extends GradientFill
{
    /**
     * The angle of the gradient fill, in degrees. Use the angle to set the
     * direction of the gradient. For example, a value of 180 defines a
     * gradient that changes color from top to bottom. An angle of 90 defines
     * a gradient that changes color from left to right.
     * @var integer|float
     */
    protected $angle;

    /**
     * This fill always has the type linear_gradient.
     * @var string
     */
    protected $type = 'linear_gradient';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['angle'])) {
            $this->setAngle($data['angle']);
        }
    }

    /**
     * Get the angle
     * @return integer|float
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * Set the angle
     * @param integer|float $angle
     * @return $this
     */
    public function setAngle($angle)
    {
        if (is_null($angle)) {
            $this->angle = null;
            return $this;
        }

        Assert::number($angle);

        $this->angle = $angle;
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
        if (isset($this->angle)) {
            $data['angle'] = $this->angle;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
