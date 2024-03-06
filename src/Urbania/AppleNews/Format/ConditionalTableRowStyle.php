<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for applying styles to table rows that meet certain
 * conditions.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/conditionaltablerowstyle.json
 */
class ConditionalTableRowStyle extends TableRowStyle
{
    /**
     * The background color for the row.
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
     * The stroke style for the divider line below the row.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The height of the row, as a number in points, or using one of the
     * available units of measure for components. See .
     * By default, the height of each row is determined by the height of the
     * content in that row.
     * @var string|integer|float
     */
    protected $height;

    /**
     * An array of one or more selectors, each of which specifies one or more
     * conditions.
     * This conditional table row style will be applied to rows that meet all
     * of the conditions of at least one of these selectors.
     * @var Format\TableRowSelector[]
     */
    protected $selectors;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['divider'])) {
            $this->setDivider($data['divider']);
        }

        if (isset($data['height'])) {
            $this->setHeight($data['height']);
        }

        if (isset($data['selectors'])) {
            $this->setSelectors($data['selectors']);
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
     * Add an item to selectors
     * @param \Urbania\AppleNews\Format\TableRowSelector|array $item
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
     * @return Format\TableRowSelector[]
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * Set the selectors
     * @param Format\TableRowSelector[] $selectors
     * @return $this
     */
    public function setSelectors($selectors)
    {
        Assert::isArray($selectors);
        Assert::allIsSdkObject($selectors, TableRowSelector::class);

        $this->selectors = is_array($selectors)
            ? array_reduce(
                array_keys($selectors),
                function ($array, $key) use ($selectors) {
                    $item = $selectors[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new TableRowSelector($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $selectors;
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
        if (isset($this->height)) {
            $data['height'] =
                $this->height instanceof Arrayable ? $this->height->toArray() : $this->height;
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
        return $data;
    }
}
