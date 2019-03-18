<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for applying styles to table columns that meet certain
 * conditions.
 *
 * @see https://developer.apple.com/documentation/apple_news/conditionaltablecolumnstyle
 */
class ConditionalTableColumnStyle extends TableColumnStyle
{
    /**
     * The background color for the column.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The stroke style for the divider line to the right of the column.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The minimum width of the column as an integer in points  or in one of
     * the available units of measure for components. See Specifying
     * Measurements for Components.
     * @var string|integer
     */
    protected $minimumWidth;

    /**
     * An array of one or more selectors, each of which specifies one or more
     * conditions.
     * @var Format\TableColumnSelector[]
     */
    protected $selectors;

    /**
     * The relative column width. This value influences the distribution of
     * column width but does not dictate any exact values. To set an exact
     * minimum width, use minimumWidth instead.
     * @var integer
     */
    protected $width;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['divider'])) {
            $this->setDivider($data['divider']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
        }

        if (isset($data['selectors'])) {
            $this->setSelectors($data['selectors']);
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
     * Get the divider
     * @return \Urbania\AppleNews\Format\TableStrokeStyle
     */
    public function getDivider()
    {
        return $this->divider;
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
     * Get the selectors
     * @return Format\TableColumnSelector[]
     */
    public function getSelectors()
    {
        return $this->selectors;
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
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Set the divider
     * @param \Urbania\AppleNews\Format\TableStrokeStyle|array $divider
     * @return $this
     */
    public function setDivider($divider)
    {
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
     * Set the minimumWidth
     * @param string|integer $minimumWidth
     * @return $this
     */
    public function setMinimumWidth($minimumWidth)
    {
        Assert::isSupportedUnits($minimumWidth);

        $this->minimumWidth = $minimumWidth;
        return $this;
    }

    /**
     * Set the selectors
     * @param Format\TableColumnSelector[] $selectors
     * @return $this
     */
    public function setSelectors($selectors)
    {
        Assert::isArray($selectors);
        Assert::allIsInstanceOfOrArray($selectors, TableColumnSelector::class);

        $items = [];
        foreach ($selectors as $key => $item) {
            $items[$key] = is_array($item)
                ? new TableColumnSelector($item)
                : $item;
        }
        $this->selectors = $items;
        return $this;
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
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        $data = parent::toArray();
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] = is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor;
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
        if (isset($this->selectors)) {
            $data['selectors'] = !is_null($this->selectors)
                ? array_reduce(
                    array_keys($this->selectors),
                    function ($items, $key) {
                        $items[$key] = is_object($this->selectors[$key])
                            ? $this->selectors[$key]->toArray()
                            : $this->selectors[$key];
                        return $items;
                    },
                    []
                )
                : $this->selectors;
        }
        if (isset($this->width)) {
            $data['width'] = $this->width;
        }
        return $data;
    }
}
