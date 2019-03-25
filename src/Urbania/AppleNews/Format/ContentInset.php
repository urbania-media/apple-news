<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining the space around the component content on one
 * or more sides.DeprecatedUse the padding property in ComponentLayout
 * instead.
 *
 * @see https://developer.apple.com/documentation/apple_news/contentinset
 */
class ContentInset extends BaseSdkObject
{
    /**
     * A Boolean value that applies an inset to the bottom of the component.
     * @var boolean
     */
    protected $bottom;

    /**
     * A Boolean value that applies an inset to the left side of the
     * component.
     * @var boolean
     */
    protected $left;

    /**
     * A Boolean value that applies an inset to the right side of the
     * component.
     * @var boolean
     */
    protected $right;

    /**
     * A Boolean value that applies an inset to the top of the component.
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
