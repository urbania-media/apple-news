<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for applying styles to columns in a table.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/tablecolumnstyle.json
 */
class TableColumnStyle extends BaseSdkObject
{
    /**
     * The background color for the table column.
     * If this property is omitted, the background is transparent.
     * The cell background color is highest priority, followed by the column,
     * and finally the row. All three colors are applied, meaning that
     * non-opaque values can cause combined colors. For example, using a red
     * row together with a blue column, both with 50% opacity, creates a
     * purple cell.
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
     * The minimum width of the columns, as a number in points or using the
     * available units of measure for components. See .
     * @var string|integer|float
     */
    protected $minimumWidth;

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
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalTableColumnStyle|array $item
     * @return $this
     */
    public function addConditional($item)
    {
        return $this->setConditional(
            !is_null($this->conditional) ? array_merge($this->conditional, [$item]) : [$item]
        );
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
        Assert::allIsSdkObject($conditional, ConditionalTableColumnStyle::class);

        $this->conditional = is_array($conditional)
            ? array_reduce(
                array_keys($conditional),
                function ($array, $key) use ($conditional) {
                    $item = $conditional[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new ConditionalTableColumnStyle($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $conditional;
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
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->conditional)) {
            $data['conditional'] = !is_null($this->conditional)
                ? array_reduce(
                    array_keys($this->conditional),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditional[$key] instanceof Arrayable
                                ? $this->conditional[$key]->toArray()
                                : $this->conditional[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditional;
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
        if (isset($this->width)) {
            $data['width'] = $this->width;
        }
        return $data;
    }
}
