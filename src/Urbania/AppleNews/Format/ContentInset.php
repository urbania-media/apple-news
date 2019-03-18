<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the space around the component content on one
 * or more sides.
 *
 * @see https://developer.apple.com/documentation/apple_news/contentinset
 */
class ContentInset
{
    /**
     * Applies an inset to the bottom of the component.
     * @var boolean
     */
    protected $bottom;

    /**
     * Applies an inset to the left side of the component.
     * @var boolean
     */
    protected $left;

    /**
     * Applies an inset to the right side of the component.
     * @var boolean
     */
    protected $right;

    /**
     * Applies an inset to the top of the component.
     * @var boolean
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
     * @return boolean
     */
    public function getBottom()
    {
        return $this->bottom;
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
     * Get the right
     * @return boolean
     */
    public function getRight()
    {
        return $this->right;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'bottom' => $this->bottom,
            'left' => $this->left,
            'right' => $this->right,
            'top' => $this->top
        ];
    }
}
