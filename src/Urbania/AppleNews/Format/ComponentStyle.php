<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for setting style properties for components, including
 * background color and fill, borders, and table styles.
 *
 * @see https://developer.apple.com/documentation/apple_news/componentstyle
 */
class ComponentStyle extends BaseSdkObject
{
    /**
     * The component's background color. Defaults to transparent.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The border for the component. Because the border is drawn inside the
     * component, it affects the size of the content within the component.
     * The bigger the border, the less available space for content.
     * @var \Urbania\AppleNews\Format\Border
     */
    protected $border;

    /**
     * A Fill object, such as an ImageFill, that will be applied on top of
     * the specified backgroundColor.
     * @var \Urbania\AppleNews\Format\Fill
     */
    protected $fill;

    /**
     * The opacity of the component, set as a float value between 0
     * (completely transparent) and 1 (completely opaque). The effects of the
     * component’s opacity are inherited by any child components. See
     * Nesting Components in an Article.
     * @var integer|float
     */
    protected $opacity;

    /**
     * The styling for the rows, columns, and cells of the component, if it
     * is a DataTable or HTMLTable component.
     * @var \Urbania\AppleNews\Format\TableStyle
     */
    protected $tableStyle;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['border'])) {
            $this->setBorder($data['border']);
        }

        if (isset($data['fill'])) {
            $this->setFill($data['fill']);
        }

        if (isset($data['opacity'])) {
            $this->setOpacity($data['opacity']);
        }

        if (isset($data['tableStyle'])) {
            $this->setTableStyle($data['tableStyle']);
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
     * @return \Urbania\AppleNews\Format\Border
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * Set the border
     * @param \Urbania\AppleNews\Format\Border|array $border
     * @return $this
     */
    public function setBorder($border)
    {
        if (is_null($border)) {
            $this->border = null;
            return $this;
        }

        if (is_object($border)) {
            Assert::isInstanceOf($border, Border::class);
        } else {
            Assert::isArray($border);
        }

        $this->border = is_array($border) ? new Border($border) : $border;
        return $this;
    }

    /**
     * Get the fill
     * @return \Urbania\AppleNews\Format\Fill
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Set the fill
     * @param \Urbania\AppleNews\Format\Fill|array $fill
     * @return $this
     */
    public function setFill($fill)
    {
        if (is_null($fill)) {
            $this->fill = null;
            return $this;
        }

        if (is_object($fill)) {
            Assert::isInstanceOf($fill, Fill::class);
        } else {
            Assert::isArray($fill);
        }

        $this->fill = is_array($fill) ? Fill::createTyped($fill) : $fill;
        return $this;
    }

    /**
     * Get the opacity
     * @return integer|float
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set the opacity
     * @param integer|float $opacity
     * @return $this
     */
    public function setOpacity($opacity)
    {
        if (is_null($opacity)) {
            $this->opacity = null;
            return $this;
        }

        Assert::number($opacity);

        $this->opacity = $opacity;
        return $this;
    }

    /**
     * Get the tableStyle
     * @return \Urbania\AppleNews\Format\TableStyle
     */
    public function getTableStyle()
    {
        return $this->tableStyle;
    }

    /**
     * Set the tableStyle
     * @param \Urbania\AppleNews\Format\TableStyle|array $tableStyle
     * @return $this
     */
    public function setTableStyle($tableStyle)
    {
        if (is_null($tableStyle)) {
            $this->tableStyle = null;
            return $this;
        }

        if (is_object($tableStyle)) {
            Assert::isInstanceOf($tableStyle, TableStyle::class);
        } else {
            Assert::isArray($tableStyle);
        }

        $this->tableStyle = is_array($tableStyle)
            ? new TableStyle($tableStyle)
            : $tableStyle;
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
        if (isset($this->border)) {
            $data['border'] = is_object($this->border)
                ? $this->border->toArray()
                : $this->border;
        }
        if (isset($this->fill)) {
            $data['fill'] = is_object($this->fill)
                ? $this->fill->toArray()
                : $this->fill;
        }
        if (isset($this->opacity)) {
            $data['opacity'] = $this->opacity;
        }
        if (isset($this->tableStyle)) {
            $data['tableStyle'] = is_object($this->tableStyle)
                ? $this->tableStyle->toArray()
                : $this->tableStyle;
        }
        return $data;
    }
}
