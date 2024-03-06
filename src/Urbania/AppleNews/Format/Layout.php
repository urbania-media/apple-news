<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining columns, gutters, and margins for your
 * article’s designed width.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/layout.json
 */
class Layout extends BaseSdkObject
{
    /**
     * The number of columns this article was designed for. You must have at
     * least one column.
     * Using a 7-column design allows components to start in columns 0 to 6,
     * and be between 1 and 7 columns wide. An article that is designed with
     * 7 columns provides sufficient layout information to automatically
     * resize for iPad, Mac, and iPhone sizes. An article designed with 20
     * columns provides more detail for the layout system and a better
     * reading experience. Below 5 columns there may not be sufficient
     * information for the layout system to automatically maintain your
     * intended design when scaling down to smaller devices.
     * @var integer
     */
    protected $columns;

    /**
     * The width (in points) this article was designed for. This property is
     * used to calculate down-scaling scenarios for smaller devices.
     * The width of the document must be sufficient to fit two margin values
     * and the gutter values that will be needed between each of the columns.
     * The width cannot be negative or . As a best practice, set the width to
     * the width of the iPad device. This helps you see the effects of
     * positioning components in different columns.
     * This property is used to automatically scale down article content for
     * smaller devices. With a 7-column design and a width of 1024 points,
     * the design is optimal for a landscape aspect ratio on an iPad device
     * and will scale down on iPhones.
     * @var integer
     */
    protected $width;

    /**
     * The gutter size for the article (in points). The gutter provides
     * spacing between columns. This property should always be an even
     * number; odd numbers are rounded up to the next even number. If this
     * property is omitted, a default gutter size of 20 is applied. If the
     * gutter is negative, the number is set to 0.
     * Note that the first column does not have a left gutter, and the last
     * column does not have a right gutter.
     * The width of the document must be sufficient to fit two margin values
     * and the gutter values that will be needed between each of the columns.
     * Note that when using a width of 1024, a margin of 60, and 7 columns,
     * the gutter cannot be greater than 150.
     * @var integer
     */
    protected $gutter;

    /**
     * The outer (left and right) margins of the article, in points. If this
     * property is omitted, a default article margin of 60 is applied. If the
     * margin is negative, the number is set to 0. If the margin is greater
     * than or equal to the width/2, the article delivery will fail.
     * The margins is sized down slightly when the article is automatically
     * scaled down for smaller devices.
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
