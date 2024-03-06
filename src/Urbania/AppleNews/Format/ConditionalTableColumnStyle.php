<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for applying styles to table columns that meet certain
 * conditions.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/conditionaltablecolumnstyle.json
 */
class ConditionalTableColumnStyle extends TableColumnStyle
{
    /**
     * The background color for the column.
     * If this property is omitted, the background is transparent.
     * The cell’s background color is highest priority, followed by column,
     * and finally row. All three colors are applied, meaning that non-opaque
     * values can cause combined colors. For example, using a red row
     * together with a blue column, both with 50% opacity, creates a purple
     * cell.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The stroke style for the divider line to the right of the column.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The minimum width of the column as a number in points, or in one of
     * the available units of measure for components. See .
     * @var string|integer|float
     */
    protected $minimumWidth;

    /**
     * An array of one or more selectors, each of which specifies one or more
     * conditions.
     * This conditional table column style will be applied to columns that
     * meet all of the conditions of at least one of the selectors.
     * @var Format\TableColumnSelector[]
     */
    protected $selectors;

    /**
     * The relative column width. This value influences the distribution of
     * column width but does not dictate any exact values. To set an exact
     * minimum width, use minimumWidth instead.
     * It might be useful to think of the value of width as a percentage of
     * the component’s width. For example, if you know that one column’s
     * width should be about half that of the whole component, and another
     * should be about a quarter of the component width, use values of 50 and
     * 25.
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

        Assert::isSdkObject($divider, TableStrokeStyle::class);

        $this->divider = Utils::isAssociativeArray($divider)
            ? new TableStrokeStyle($divider)
            : $divider;
        return $this;
    }

    /**
     * Get the minimumWidth
     * @return string|integer|float
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * Set the minimumWidth
     * @param string|integer|float $minimumWidth
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
     * Add an item to selectors
     * @param \Urbania\AppleNews\Format\TableColumnSelector|array $item
     * @return $this
     */
    public function addSelector($item)
    {
        return $this->setSelectors(
            !is_null($this->selectors) ? array_merge($this->selectors, [$item]) : [$item]
        );
    }

    /**
     * Add items to selectors
     * @param array $items
     * @return $this
     */
    public function addSelectors($items)
    {
        Assert::isArray($items);
        return $this->setSelectors(
            !is_null($this->selectors) ? array_merge($this->selectors, $items) : $items
        );
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
     * Set the selectors
     * @param Format\TableColumnSelector[] $selectors
     * @return $this
     */
    public function setSelectors($selectors)
    {
        Assert::isArray($selectors);
        Assert::allIsSdkObject($selectors, TableColumnSelector::class);

        $this->selectors = is_array($selectors)
            ? array_reduce(
                array_keys($selectors),
                function ($array, $key) use ($selectors) {
                    $item = $selectors[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new TableColumnSelector($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $selectors;
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
        $data = parent::toArray();
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->divider)) {
            $data['divider'] =
                $this->divider instanceof Arrayable ? $this->divider->toArray() : $this->divider;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] =
                $this->minimumWidth instanceof Arrayable
                    ? $this->minimumWidth->toArray()
                    : $this->minimumWidth;
        }
        if (isset($this->selectors)) {
            $data['selectors'] = !is_null($this->selectors)
                ? array_reduce(
                    array_keys($this->selectors),
                    function ($items, $key) {
                        $items[$key] =
                            $this->selectors[$key] instanceof Arrayable
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
