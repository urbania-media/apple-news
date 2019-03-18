<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for setting borders for tables.
 *
 * @see https://developer.apple.com/documentation/apple_news/tableborder
 */
class TableBorder implements \JsonSerializable
{
    /**
     * Defines the stroke properties of the border. Stroke properties cannot
     * be set for each side; the border can only be disabled or enabled for
     * each side.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
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
     * @return \Urbania\AppleNews\Format\TableStrokeStyle
     */
    public function getAll()
    {
        return $this->all;
    }

    /**
     * Set the all
     * @param \Urbania\AppleNews\Format\TableStrokeStyle|array $all
     * @return $this
     */
    public function setAll($all)
    {
        if (is_object($all)) {
            Assert::isInstanceOf($all, TableStrokeStyle::class);
        } else {
            Assert::isArray($all);
        }

        $this->all = is_array($all) ? new TableStrokeStyle($all) : $all;
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
        Assert::boolean($top);

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
        if (isset($this->all)) {
            $data['all'] = is_object($this->all)
                ? $this->all->toArray()
                : $this->all;
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
