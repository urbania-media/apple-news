<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for applying styles to rows in a table.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/tablerowstyle.json
 */
class TableRowStyle extends BaseSdkObject
{
    /**
     * The background color for the table row.
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
     * An array of styles to be applied only to rows that meet specified
     * conditions. This can be used to create a table with alternating row
     * background colors.
     * @var Format\ConditionalTableRowStyle[]
     */
    protected $conditional;

    /**
     * The stroke style for the divider lines between rows.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The height of the table row, as a number in points, or using the
     * available units for components.
     * By default, the height of each row is determined by the height of the
     * content in that row. See
     * @var string|integer|float
     */
    protected $height;

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

        if (isset($data['height'])) {
            $this->setHeight($data['height']);
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
     * @param \Urbania\AppleNews\Format\ConditionalTableRowStyle|array $item
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
     * @return Format\ConditionalTableRowStyle[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalTableRowStyle[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalTableRowStyle::class);

        $this->conditional = is_array($conditional)
            ? array_reduce(
                array_keys($conditional),
                function ($array, $key) use ($conditional) {
                    $item = $conditional[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new ConditionalTableRowStyle($item)
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
     * Get the height
     * @return string|integer|float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the height
     * @param string|integer|float $height
     * @return $this
     */
    public function setHeight($height)
    {
        if (is_null($height)) {
            $this->height = null;
            return $this;
        }

        Assert::isSupportedUnits($height);

        $this->height = $height;
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
        if (isset($this->height)) {
            $data['height'] =
                $this->height instanceof Arrayable ? $this->height->toArray() : $this->height;
        }
        return $data;
    }
}
