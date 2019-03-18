<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining space around the content in a table cell.
 *
 * @see https://developer.apple.com/documentation/apple_news/padding
 */
class Padding implements \JsonSerializable
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
        Assert::isSupportedUnits($top);

        $this->top = $top;
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
        if (isset($this->bottom)) {
            $data['bottom'] = is_object($this->bottom)
                ? $this->bottom->toArray()
                : $this->bottom;
        }
        if (isset($this->left)) {
            $data['left'] = is_object($this->left)
                ? $this->left->toArray()
                : $this->left;
        }
        if (isset($this->right)) {
            $data['right'] = is_object($this->right)
                ? $this->right->toArray()
                : $this->right;
        }
        if (isset($this->top)) {
            $data['top'] = is_object($this->top)
                ? $this->top->toArray()
                : $this->top;
        }
        return $data;
    }
}
