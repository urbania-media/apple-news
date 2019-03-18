<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for applying styles to cells in a table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecellstyle
 */
class TableCellStyle implements \JsonSerializable
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
     * one of the units of measure for components.See Specifying Measurements
     * for Components.
     * @var string|integer
     */
    protected $height;

    /**
     * Defines the horizontal alignment of content inside cells.
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
     * Defines the vertical alignment of content inside cells.
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
        if (is_object($border)) {
            Assert::isInstanceOf($border, TableBorder::class);
        } else {
            Assert::isArray($border);
        }

        $this->border = is_array($border) ? new TableBorder($border) : $border;
        return $this;
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
        Assert::isArray($conditional);
        Assert::allIsInstanceOfOrArray(
            $conditional,
            ConditionalTableCellStyle::class
        );

        $items = [];
        foreach ($conditional as $key => $item) {
            $items[$key] = is_array($item)
                ? new ConditionalTableCellStyle($item)
                : $item;
        }
        $this->conditional = $items;
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
        if (is_object($padding)) {
            Assert::isInstanceOf($padding, Padding::class);
        } elseif (!is_array($padding)) {
            Assert::SupportedUnits($padding);
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
        if (is_object($textStyle)) {
            Assert::isInstanceOf($textStyle, ComponentTextStyle::class);
        } elseif (!is_array($textStyle)) {
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
        Assert::integer($width);

        $this->width = $width;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        $data = [];
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] = is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor;
        }
        if (isset($this->border)) {
            $data['border'] = is_object($this->border)
                ? $this->border->toArray()
                : $this->border;
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
        if (isset($this->height)) {
            $data['height'] = is_object($this->height)
                ? $this->height->toArray()
                : $this->height;
        }
        if (isset($this->horizontalAlignment)) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] = is_object($this->minimumWidth)
                ? $this->minimumWidth->toArray()
                : $this->minimumWidth;
        }
        if (isset($this->padding)) {
            $data['padding'] = is_object($this->padding)
                ? $this->padding->toArray()
                : $this->padding;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] = is_object($this->textStyle)
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
