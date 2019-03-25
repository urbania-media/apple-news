<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
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
     * An array of component style properties that are applied conditionally,
     * and the conditions that cause them to be applied.
     * @var Format\ConditionalComponentStyle[]
     */
    protected $conditional;

    /**
     * The component's background color. The value defaults to transparent.
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
     * The object that defines a mask that clips the contents of the
     * component to the specified masking behavior.
     * @var \Urbania\AppleNews\Format\CornerMask
     */
    protected $mask;

    /**
     * The opacity of the component, set as a float value between 0
     * (completely transparent) and 1 (completely opaque). The effects of the
     * component’s opacity are inherited by any child components. See
     * Nesting Components in an Article.
     * @var float|integer
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
        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['border'])) {
            $this->setBorder($data['border']);
        }

        if (isset($data['fill'])) {
            $this->setFill($data['fill']);
        }

        if (isset($data['mask'])) {
            $this->setMask($data['mask']);
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

        Assert::isSdkObject($border, Border::class);

        $this->border = is_array($border) ? new Border($border) : $border;
        return $this;
    }

    /**
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalComponentStyle|array $item
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
     * @return Format\ConditionalComponentStyle[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalComponentStyle[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalComponentStyle::class);

        $this->conditional = array_reduce(
            array_keys($conditional),
            function ($array, $key) use ($conditional) {
                $item = $conditional[$key];
                $array[$key] = is_array($item)
                    ? new ConditionalComponentStyle($item)
                    : $item;
                return $array;
            },
            []
        );
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

        Assert::isSdkObject($fill, Fill::class);

        $this->fill = is_array($fill) ? Fill::createTyped($fill) : $fill;
        return $this;
    }

    /**
     * Get the mask
     * @return \Urbania\AppleNews\Format\CornerMask
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set the mask
     * @param \Urbania\AppleNews\Format\CornerMask|array $mask
     * @return $this
     */
    public function setMask($mask)
    {
        if (is_null($mask)) {
            $this->mask = null;
            return $this;
        }

        Assert::isSdkObject($mask, CornerMask::class);

        $this->mask = is_array($mask) ? new CornerMask($mask) : $mask;
        return $this;
    }

    /**
     * Get the opacity
     * @return float|integer
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set the opacity
     * @param float|integer $opacity
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

        Assert::isSdkObject($tableStyle, TableStyle::class);

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
        if (isset($this->fill)) {
            $data['fill'] =
                $this->fill instanceof Arrayable
                    ? $this->fill->toArray()
                    : $this->fill;
        }
        if (isset($this->mask)) {
            $data['mask'] =
                $this->mask instanceof Arrayable
                    ? $this->mask->toArray()
                    : $this->mask;
        }
        if (isset($this->opacity)) {
            $data['opacity'] = $this->opacity;
        }
        if (isset($this->tableStyle)) {
            $data['tableStyle'] =
                $this->tableStyle instanceof Arrayable
                    ? $this->tableStyle->toArray()
                    : $this->tableStyle;
        }
        return $data;
    }
}
