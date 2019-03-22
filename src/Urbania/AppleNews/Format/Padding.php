<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining space around the content in a table cell.
 *
 * @see https://developer.apple.com/documentation/apple_news/padding
 */
class Padding extends BaseSdkObject
{
    /**
     * The amount of padding between the bottom of the cell and the content,
     * as an integer in points or using the available units for components.
     * See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $bottom;

    /**
     * The amount of padding between the left side of the cell and the
     * content, as an integer in points or using the available units for
     * components.See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $left;

    /**
     * The amount of padding between the right side of the cell and the
     * content, as an integer in points or using the available units for
     * components.See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $right;

    /**
     * The amount of padding between the top of the cell and the content, as
     * an integer in points or using the available units for components.See
     * Specifying Measurements for Components.
     * @var string|integer
     */
    protected $top;

    public function __construct(array $data = [])
    {
        if (isset($data['bottom'])) {
            $this->setBottom($data['bottom']);
        }

        if (isset($data['left'])) {
            $this->setLeft($data['left']);
        }

        if (isset($data['right'])) {
            $this->setRight($data['right']);
        }

        if (isset($data['top'])) {
            $this->setTop($data['top']);
        }
    }

    /**
     * Get the bottom
     * @return string|integer
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * Set the bottom
     * @param string|integer $bottom
     * @return $this
     */
    public function setBottom($bottom)
    {
        if (is_null($bottom)) {
            $this->bottom = null;
            return $this;
        }

        Assert::isSupportedUnits($bottom);

        $this->bottom = $bottom;
        return $this;
    }

    /**
     * Get the left
     * @return string|integer
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set the left
     * @param string|integer $left
     * @return $this
     */
    public function setLeft($left)
    {
        if (is_null($left)) {
            $this->left = null;
            return $this;
        }

        Assert::isSupportedUnits($left);

        $this->left = $left;
        return $this;
    }

    /**
     * Get the right
     * @return string|integer
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set the right
     * @param string|integer $right
     * @return $this
     */
    public function setRight($right)
    {
        if (is_null($right)) {
            $this->right = null;
            return $this;
        }

        Assert::isSupportedUnits($right);

        $this->right = $right;
        return $this;
    }

    /**
     * Get the top
     * @return string|integer
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set the top
     * @param string|integer $top
     * @return $this
     */
    public function setTop($top)
    {
        if (is_null($top)) {
            $this->top = null;
            return $this;
        }

        Assert::isSupportedUnits($top);

        $this->top = $top;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->bottom)) {
            $data['bottom'] =
                $this->bottom instanceof Arrayable
                    ? $this->bottom->toArray()
                    : $this->bottom;
        }
        if (isset($this->left)) {
            $data['left'] =
                $this->left instanceof Arrayable
                    ? $this->left->toArray()
                    : $this->left;
        }
        if (isset($this->right)) {
            $data['right'] =
                $this->right instanceof Arrayable
                    ? $this->right->toArray()
                    : $this->right;
        }
        if (isset($this->top)) {
            $data['top'] =
                $this->top instanceof Arrayable
                    ? $this->top->toArray()
                    : $this->top;
        }
        return $data;
    }
}
