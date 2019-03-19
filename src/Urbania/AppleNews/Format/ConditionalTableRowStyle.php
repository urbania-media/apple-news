<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for applying styles to table rows that meet certain
 * conditions.
 *
 * @see https://developer.apple.com/documentation/apple_news/conditionaltablerowstyle
 */
class ConditionalTableRowStyle extends TableRowStyle
{
    /**
     * The background color for the row.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The stroke style for the divider line below the row.
     * @var \Urbania\AppleNews\Format\TableStrokeStyle
     */
    protected $divider;

    /**
     * The height of the row, as an integer in points, or using one of the
     * available units of measure for components. See Specifying Measurements
     * for Components.
     * @var string|integer
     */
    protected $height;

    /**
     * An array of one or more selectors, each of which specifies one or more
     * conditions.
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
     * Get the height
     * @return string|integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the height
     * @param string|integer $height
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
        Assert::allIsInstanceOfOrArray($selectors, TableRowSelector::class);

        $items = [];
        foreach ($selectors as $key => $item) {
            $items[$key] = is_array($item)
                ? new TableRowSelector($item)
                : $item;
        }
        $this->selectors = $items;
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
            $data['backgroundColor'] = is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor;
        }
        if (isset($this->divider)) {
            $data['divider'] = is_object($this->divider)
                ? $this->divider->toArray()
                : $this->divider;
        }
        if (isset($this->height)) {
            $data['height'] = is_object($this->height)
                ? $this->height->toArray()
                : $this->height;
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
        return $data;
    }
}
