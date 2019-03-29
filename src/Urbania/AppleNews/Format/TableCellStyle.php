<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for applying styles to cells in a table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecellstyle
 */
class TableCellStyle extends BaseSdkObject
{
    /**
     * The background color for the cell.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The border for the cell. Because the border is drawn inside the cell,
     * it affects the size of the content within the cell. The bigger the
     * border, the less available space for content.
     * @var \Urbania\AppleNews\Format\TableBorder
     */
    protected $border;

    /**
     * An array of styles to be applied only to cells that meet specified
     * conditions. This can be used to change the appearance of specific
     * table cells.
     * @var Format\ConditionalTableCellStyle[]
     */
    protected $conditional;

    /**
     * The height of the cell and its row, as an integer in points, or using
     * one of the units of measure for components. See Specifying
     * Measurements for Components.
     * @var string|integer
     */
    protected $height;

    /**
     * A string that defines the horizontal alignment of content inside
     * cells.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * The minimum width of the cell and its column, as an integer in points
     * or in one of the available units of measure for components. See
     * Specifying Measurements for Components.
     * @var string|integer
     */
    protected $minimumWidth;

    /**
     * The space around the content in a table cell in points, supported
     * units, or a Padding object that specifies padding for each side
     * separately.
     * @var \Urbania\AppleNews\Format\Padding|string|integer
     */
    protected $padding;

    /**
     * The name string of one of your styles in the Article
     * ArticleDocument.componentTextStyles object.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    /**
     * A string that defines the vertical alignment of content inside cells.
     * @var string
     */
    protected $verticalAlignment;

    /**
     * The column width, as a percentage only. This property only indicates
     * proportionate width and cannot be used to control exact width. See
     * minimumWidth.
     * @var integer
     */
    protected $width;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['border'])) {
            $this->setBorder($data['border']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['height'])) {
            $this->setHeight($data['height']);
        }

        if (isset($data['horizontalAlignment'])) {
            $this->setHorizontalAlignment($data['horizontalAlignment']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
        }

        if (isset($data['padding'])) {
            $this->setPadding($data['padding']);
        }

        if (isset($data['textStyle'])) {
            $this->setTextStyle($data['textStyle']);
        }

        if (isset($data['verticalAlignment'])) {
            $this->setVerticalAlignment($data['verticalAlignment']);
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
     * Get the border
     * @return \Urbania\AppleNews\Format\TableBorder
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * Set the border
     * @param \Urbania\AppleNews\Format\TableBorder|array $border
     * @return $this
     */
    public function setBorder($border)
    {
        if (is_null($border)) {
            $this->border = null;
            return $this;
        }

        Assert::isSdkObject($border, TableBorder::class);

        $this->border = is_array($border) ? new TableBorder($border) : $border;
        return $this;
    }

    /**
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalTableCellStyle|array $item
     * @return $this
     */
    public function addConditional($item)
    {
        return $this->setConditional(
            !is_null($this->conditional)
                ? array_merge($this->conditional, [$item])
                : [$item]
        );
    }

    /**
     * Get the conditional
     * @return Format\ConditionalTableCellStyle[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalTableCellStyle[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalTableCellStyle::class);

        $this->conditional = array_reduce(
            array_keys($conditional),
            function ($array, $key) use ($conditional) {
                $item = $conditional[$key];
                $array[$key] = is_array($item)
                    ? new ConditionalTableCellStyle($item)
                    : $item;
                return $array;
            },
            []
        );
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
     * Get the horizontalAlignment
     * @return string
     */
    public function getHorizontalAlignment()
    {
        return $this->horizontalAlignment;
    }

    /**
     * Set the horizontalAlignment
     * @param string $horizontalAlignment
     * @return $this
     */
    public function setHorizontalAlignment($horizontalAlignment)
    {
        if (is_null($horizontalAlignment)) {
            $this->horizontalAlignment = null;
            return $this;
        }

        Assert::oneOf($horizontalAlignment, ["left", "center", "right"]);

        $this->horizontalAlignment = $horizontalAlignment;
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
     * Get the padding
     * @return \Urbania\AppleNews\Format\Padding|string|integer
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Set the padding
     * @param \Urbania\AppleNews\Format\Padding|array|string|integer $padding
     * @return $this
     */
    public function setPadding($padding)
    {
        if (is_null($padding)) {
            $this->padding = null;
            return $this;
        }

        if (is_object($padding) || is_array($padding)) {
            Assert::isSdkObject($padding, Padding::class);
        } else {
            Assert::isSupportedUnits($padding);
        }

        $this->padding = is_array($padding) ? new Padding($padding) : $padding;
        return $this;
    }

    /**
     * Get the textStyle
     * @return \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    public function getTextStyle()
    {
        return $this->textStyle;
    }

    /**
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\ComponentTextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_null($textStyle)) {
            $this->textStyle = null;
            return $this;
        }

        if (is_object($textStyle) || is_array($textStyle)) {
            Assert::isSdkObject($textStyle, ComponentTextStyle::class);
        } else {
            Assert::string($textStyle);
        }

        $this->textStyle = is_array($textStyle)
            ? new ComponentTextStyle($textStyle)
            : $textStyle;
        return $this;
    }

    /**
     * Get the verticalAlignment
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->verticalAlignment;
    }

    /**
     * Set the verticalAlignment
     * @param string $verticalAlignment
     * @return $this
     */
    public function setVerticalAlignment($verticalAlignment)
    {
        if (is_null($verticalAlignment)) {
            $this->verticalAlignment = null;
            return $this;
        }

        Assert::oneOf($verticalAlignment, ["top", "center", "bottom"]);

        $this->verticalAlignment = $verticalAlignment;
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
        if (isset($this->border)) {
            $data['border'] =
                $this->border instanceof Arrayable
                    ? $this->border->toArray()
                    : $this->border;
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
        if (isset($this->height)) {
            $data['height'] =
                $this->height instanceof Arrayable
                    ? $this->height->toArray()
                    : $this->height;
        }
        if (isset($this->horizontalAlignment)) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] =
                $this->minimumWidth instanceof Arrayable
                    ? $this->minimumWidth->toArray()
                    : $this->minimumWidth;
        }
        if (isset($this->padding)) {
            $data['padding'] =
                $this->padding instanceof Arrayable
                    ? $this->padding->toArray()
                    : $this->padding;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] =
                $this->textStyle instanceof Arrayable
                    ? $this->textStyle->toArray()
                    : $this->textStyle;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        if (isset($this->width)) {
            $data['width'] = $this->width;
        }
        return $data;
    }
}
