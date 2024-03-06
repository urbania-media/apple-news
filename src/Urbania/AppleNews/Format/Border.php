<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for setting borders for component sides or tables.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/border.json
 */
class Border extends BaseSdkObject
{
    /**
     * Defines the stroke properties of the border. Stroke properties cannot
     * be set for each side; the border can only be disabled or enabled for
     * each side.
     * @var \Urbania\AppleNews\Format\StrokeStyle
     */
    protected $all;

    /**
     * Indicates whether the border should be applied to the bottom.
     * @var boolean
     */
    protected $bottom;

    /**
     * Indicates whether the border should be applied to the left side.
     * @var boolean
     */
    protected $left;

    /**
     * Indicates whether the border should be applied to the right side.
     * @var boolean
     */
    protected $right;

    /**
     * Indicates whether the border should be applied to the top.
     * @var boolean
     */
    protected $top;

    public function __construct(array $data = [])
    {
        if (isset($data['all'])) {
            $this->setAll($data['all']);
        }

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
     * Get the all
     * @return \Urbania\AppleNews\Format\StrokeStyle
     */
    public function getAll()
    {
        return $this->all;
    }

    /**
     * Set the all
     * @param \Urbania\AppleNews\Format\StrokeStyle|array $all
     * @return $this
     */
    public function setAll($all)
    {
        if (is_null($all)) {
            $this->all = null;
            return $this;
        }

        Assert::isSdkObject($all, StrokeStyle::class);

        $this->all = Utils::isAssociativeArray($all) ? new StrokeStyle($all) : $all;
        return $this;
    }

    /**
     * Get the bottom
     * @return boolean
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * Set the bottom
     * @param boolean $bottom
     * @return $this
     */
    public function setBottom($bottom)
    {
        if (is_null($bottom)) {
            $this->bottom = null;
            return $this;
        }

        Assert::boolean($bottom);

        $this->bottom = $bottom;
        return $this;
    }

    /**
     * Get the left
     * @return boolean
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set the left
     * @param boolean $left
     * @return $this
     */
    public function setLeft($left)
    {
        if (is_null($left)) {
            $this->left = null;
            return $this;
        }

        Assert::boolean($left);

        $this->left = $left;
        return $this;
    }

    /**
     * Get the right
     * @return boolean
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set the right
     * @param boolean $right
     * @return $this
     */
    public function setRight($right)
    {
        if (is_null($right)) {
            $this->right = null;
            return $this;
        }

        Assert::boolean($right);

        $this->right = $right;
        return $this;
    }

    /**
     * Get the top
     * @return boolean
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set the top
     * @param boolean $top
     * @return $this
     */
    public function setTop($top)
    {
        if (is_null($top)) {
            $this->top = null;
            return $this;
        }

        Assert::boolean($top);

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
        if (isset($this->all)) {
            $data['all'] = $this->all instanceof Arrayable ? $this->all->toArray() : $this->all;
        }
        if (isset($this->bottom)) {
            $data['bottom'] = $this->bottom;
        }
        if (isset($this->left)) {
            $data['left'] = $this->left;
        }
        if (isset($this->right)) {
            $data['right'] = $this->right;
        }
        if (isset($this->top)) {
            $data['top'] = $this->top;
        }
        return $data;
    }
}
