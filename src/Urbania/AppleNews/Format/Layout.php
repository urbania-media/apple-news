<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining columns, gutters, and margins for your
 * article’s designed width.
 *
 * @see https://developer.apple.com/documentation/apple_news/layout
 */
class Layout extends BaseSdkObject
{
    /**
     * The number of columns this article was designed for. You must have at
     * least one column.
     * @var integer
     */
    protected $columns;

    /**
     * The width (in points) this article was designed for. This property is
     * used to calculate down-scaling scenarios for smaller devices.
     * @var integer
     */
    protected $width;

    /**
     * The gutter size for the article (in points). The gutter provides
     * spacing between columns. This property should always be an even
     * number; odd numbers are rounded up to the next even number. If this
     * property is omitted, a default gutter size of 20 is applied. If the
     * gutter is negative, the number will be set to 0.
     * @var integer
     */
    protected $gutter;

    /**
     * The outer (left and right) margins of the article, in points. If this
     * property is omitted, a default article margin of 60 is applied. If the
     * margin is negative, the number is set to 0. If the margin is greater
     * than or equal to the width/2, the article delivery fails.
     * @var integer
     */
    protected $margin;

    public function __construct(array $data = [])
    {
        if (isset($data['columns'])) {
            $this->setColumns($data['columns']);
        }

        if (isset($data['width'])) {
            $this->setWidth($data['width']);
        }

        if (isset($data['gutter'])) {
            $this->setGutter($data['gutter']);
        }

        if (isset($data['margin'])) {
            $this->setMargin($data['margin']);
        }
    }

    /**
     * Get the columns
     * @return integer
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the columns
     * @param integer $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        Assert::integer($columns);

        $this->columns = $columns;
        return $this;
    }

    /**
     * Get the gutter
     * @return integer
     */
    public function getGutter()
    {
        return $this->gutter;
    }

    /**
     * Set the gutter
     * @param integer $gutter
     * @return $this
     */
    public function setGutter($gutter)
    {
        if (is_null($gutter)) {
            $this->gutter = null;
            return $this;
        }

        Assert::integer($gutter);

        $this->gutter = $gutter;
        return $this;
    }

    /**
     * Get the margin
     * @return integer
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * Set the margin
     * @param integer $margin
     * @return $this
     */
    public function setMargin($margin)
    {
        if (is_null($margin)) {
            $this->margin = null;
            return $this;
        }

        Assert::integer($margin);

        $this->margin = $margin;
        return $this;
    }

    /**
     * Get the width
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the width
     * @param integer $width
     * @return $this
     */
    public function setWidth($width)
    {
        Assert::integer($width);

        $this->width = $width;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->columns)) {
            $data['columns'] = $this->columns;
        }
        if (isset($this->width)) {
            $data['width'] = $this->width;
        }
        if (isset($this->gutter)) {
            $data['gutter'] = $this->gutter;
        }
        if (isset($this->margin)) {
            $data['margin'] = $this->margin;
        }
        return $data;
    }
}
