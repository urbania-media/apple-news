<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for creating rounded corners.
 *
 * @see https://developer.apple.com/documentation/apple_news/cornermask
 */
class CornerMask extends BaseSdkObject
{
    /**
     * A Boolean that indicates whether the bottom-left corner should be
     * masked.
     * @var boolean
     */
    protected $bottomLeft;

    /**
     * A Boolean that indicates whether the bottom-right corner should be
     * masked.
     * @var boolean
     */
    protected $bottomRight;

    /**
     * A supported unit or integer that describes the radius of the corners
     * in points. Corner radius cannot exceed half the component width or
     * height, whichever is smaller.
     * @var string|integer
     */
    protected $radius;

    /**
     * A Boolean that indicates whether the top-left corner should be masked.
     * @var boolean
     */
    protected $topLeft;

    /**
     * A Boolean that indicates whether the top-right corner should be
     * masked.
     * @var boolean
     */
    protected $topRight;

    /**
     * The type of mask. The value is always corners.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['bottomLeft'])) {
            $this->setBottomLeft($data['bottomLeft']);
        }

        if (isset($data['bottomRight'])) {
            $this->setBottomRight($data['bottomRight']);
        }

        if (isset($data['radius'])) {
            $this->setRadius($data['radius']);
        }

        if (isset($data['topLeft'])) {
            $this->setTopLeft($data['topLeft']);
        }

        if (isset($data['topRight'])) {
            $this->setTopRight($data['topRight']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
    }

    /**
     * Get the bottomLeft
     * @return boolean
     */
    public function getBottomLeft()
    {
        return $this->bottomLeft;
    }

    /**
     * Set the bottomLeft
     * @param boolean $bottomLeft
     * @return $this
     */
    public function setBottomLeft($bottomLeft)
    {
        if (is_null($bottomLeft)) {
            $this->bottomLeft = null;
            return $this;
        }

        Assert::boolean($bottomLeft);

        $this->bottomLeft = $bottomLeft;
        return $this;
    }

    /**
     * Get the bottomRight
     * @return boolean
     */
    public function getBottomRight()
    {
        return $this->bottomRight;
    }

    /**
     * Set the bottomRight
     * @param boolean $bottomRight
     * @return $this
     */
    public function setBottomRight($bottomRight)
    {
        if (is_null($bottomRight)) {
            $this->bottomRight = null;
            return $this;
        }

        Assert::boolean($bottomRight);

        $this->bottomRight = $bottomRight;
        return $this;
    }

    /**
     * Get the radius
     * @return string|integer
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Set the radius
     * @param string|integer $radius
     * @return $this
     */
    public function setRadius($radius)
    {
        if (is_null($radius)) {
            $this->radius = null;
            return $this;
        }

        Assert::isSupportedUnits($radius);

        $this->radius = $radius;
        return $this;
    }

    /**
     * Get the topLeft
     * @return boolean
     */
    public function getTopLeft()
    {
        return $this->topLeft;
    }

    /**
     * Set the topLeft
     * @param boolean $topLeft
     * @return $this
     */
    public function setTopLeft($topLeft)
    {
        if (is_null($topLeft)) {
            $this->topLeft = null;
            return $this;
        }

        Assert::boolean($topLeft);

        $this->topLeft = $topLeft;
        return $this;
    }

    /**
     * Get the topRight
     * @return boolean
     */
    public function getTopRight()
    {
        return $this->topRight;
    }

    /**
     * Set the topRight
     * @param boolean $topRight
     * @return $this
     */
    public function setTopRight($topRight)
    {
        if (is_null($topRight)) {
            $this->topRight = null;
            return $this;
        }

        Assert::boolean($topRight);

        $this->topRight = $topRight;
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        if (is_null($type)) {
            $this->type = null;
            return $this;
        }

        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->bottomLeft)) {
            $data['bottomLeft'] = $this->bottomLeft;
        }
        if (isset($this->bottomRight)) {
            $data['bottomRight'] = $this->bottomRight;
        }
        if (isset($this->radius)) {
            $data['radius'] =
                $this->radius instanceof Arrayable
                    ? $this->radius->toArray()
                    : $this->radius;
        }
        if (isset($this->topLeft)) {
            $data['topLeft'] = $this->topLeft;
        }
        if (isset($this->topRight)) {
            $data['topRight'] = $this->topRight;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
