<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for applying styles to columns in a table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecolumnstyle
 */
class TableColumnStyle extends BaseSdkObject
{
    /**
     * The background color for the table column.
     * @var string
     */
    protected $backgroundColor;

    /**
     * An array of styles to be applied only to columns that meet specified
     * conditions. This can be used to create a table with alternating column
     * background colors.
     * @var Format\ConditionalTableColumnStyle[]
     */
    protected $conditional;

    /**
     * The stroke style for the divider lines between columns.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The minimum width of the columns, as an integer in points or using the
     * available units of measure for components. See Specifying Measurements
     * for Components.
     * @var string|integer
     */
    protected $minimumWidth;

    /**
     * The relative column width. This value influences the distribution of
     * column width but does not dictate any exact values. To set an exact
     * minimum width, use minimumWidth instead.
     * @var integer
     */
    protected $width;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['divider'])) {
            $this->setDivider($data['divider']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
        }

        if (isset($data['width'])) {
            $this->setWidth($data['width']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalTableColumnStyle[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalTableColumnStyle[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsInstanceOfOrArray(
            $conditional,
            ConditionalTableColumnStyle::class
        );

        $items = [];
        foreach ($conditional as $key => $item) {
            $items[$key] = is_array($item)
                ? new ConditionalTableColumnStyle($item)
                : $item;
        }
        $this->conditional = $items;
        return $this;
    }

    /**
     * Get the divider
     * @return \Urbania\AppleNews\Format\TableStrokeStyle
     */
    public function getDivider()
    {
        return $this->divider;
    }

    /**
     * Set the divider
     * @param \Urbania\AppleNews\Format\TableStrokeStyle|array $divider
     * @return $this
     */
    public function setDivider($divider)
    {
        if (is_null($divider)) {
            $this->divider = null;
            return $this;
        }

        if (is_object($divider)) {
            Assert::isInstanceOf($divider, TableStrokeStyle::class);
        } else {
            Assert::isArray($divider);
        }

        $this->divider = is_array($divider)
            ? new TableStrokeStyle($divider)
            : $divider;
        return $this;
    }

    /**
     * Get the minimumWidth
     * @return string|integer
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * Set the minimumWidth
     * @param string|integer $minimumWidth
     * @return $this
     */
    public function setMinimumWidth($minimumWidth)
    {
        if (is_null($minimumWidth)) {
            $this->minimumWidth = null;
            return $this;
        }

        Assert::isSupportedUnits($minimumWidth);

        $this->minimumWidth = $minimumWidth;
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
        if (is_null($width)) {
            $this->width = null;
            return $this;
        }

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
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] = is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor;
        }
        if (isset($this->conditional)) {
            $data['conditional'] = !is_null($this->conditional)
                ? array_reduce(
                    array_keys($this->conditional),
                    function ($items, $key) {
                        $items[$key] = is_object($this->conditional[$key])
                            ? $this->conditional[$key]->toArray()
                            : $this->conditional[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditional;
        }
        if (isset($this->divider)) {
            $data['divider'] = is_object($this->divider)
                ? $this->divider->toArray()
                : $this->divider;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] = is_object($this->minimumWidth)
                ? $this->minimumWidth->toArray()
                : $this->minimumWidth;
        }
        if (isset($this->width)) {
            $data['width'] = $this->width;
        }
        return $data;
    }
}
