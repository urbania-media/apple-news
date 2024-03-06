<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for setting style properties for components, including
 * background color and fill, borders, and table styles.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/componentstyle.json
 */
class ComponentStyle extends BaseSdkObject
{
    /**
     * An instance or array of component style properties that are applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalComponentStyle[]|\Urbania\AppleNews\Format\ConditionalComponentStyle
     */
    protected $conditional;

    /**
     * The component's background color. The value defaults to transparent.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var string|none
     */
    protected $backgroundColor;

    /**
     * The border for the component. Because the border is drawn inside the
     * component, it affects the size of the content within the component.
     * The bigger the border, the less available space for content.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\Border|none
     */
    protected $border;

    /**
     * A Fill object, such as an , that will be applied on top of the
     * specified backgroundColor.
     * By default, no fill is applied.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\Fill|none
     */
    protected $fill;

    /**
     * The object that defines a mask that clips the contents of the
     * component to the specified masking behavior.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\CornerMask|none
     */
    protected $mask;

    /**
     * The opacity of the component, set as a float value between
     * (completely transparent) and 1 (completely opaque). The effects of the
     * component’s opacity are inherited by any child components. See .
     * @var integer|float
     */
    protected $opacity;

    /**
     * The styling for the rows, columns, and cells of the component, if it
     * is a  or  component.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\TableStyle|none
     */
    protected $tableStyle;

    /**
     * The object that defines a component shadow.
     * @var \Urbania\AppleNews\Format\ComponentShadow
     */
    protected $shadow;

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

        if (isset($data['shadow'])) {
            $this->setShadow($data['shadow']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string|none
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string|none $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        if ($backgroundColor !== 'none') {
            Assert::isColor($backgroundColor);
        }

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the border
     * @return \Urbania\AppleNews\Format\Border|none
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * Set the border
     * @param \Urbania\AppleNews\Format\Border|array|none $border
     * @return $this
     */
    public function setBorder($border)
    {
        if (is_null($border)) {
            $this->border = null;
            return $this;
        }

        if (is_object($border) || Utils::isAssociativeArray($border)) {
            Assert::isSdkObject($border, Border::class);
        } else {
            Assert::eq($border, 'none');
        }

        $this->border = Utils::isAssociativeArray($border) ? new Border($border) : $border;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalComponentStyle[]|\Urbania\AppleNews\Format\ConditionalComponentStyle
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalComponentStyle[]|\Urbania\AppleNews\Format\ConditionalComponentStyle|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalComponentStyle::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalComponentStyle::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalComponentStyle($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the fill
     * @return \Urbania\AppleNews\Format\Fill|none
     */
    public function getFill()
    {
        return $this->fill;
    }

    /**
     * Set the fill
     * @param \Urbania\AppleNews\Format\Fill|array|none $fill
     * @return $this
     */
    public function setFill($fill)
    {
        if (is_null($fill)) {
            $this->fill = null;
            return $this;
        }

        if (is_object($fill) || Utils::isAssociativeArray($fill)) {
            Assert::isSdkObject($fill, Fill::class);
        } else {
            Assert::eq($fill, 'none');
        }

        $this->fill = Utils::isAssociativeArray($fill) ? Fill::createTyped($fill) : $fill;
        return $this;
    }

    /**
     * Get the mask
     * @return \Urbania\AppleNews\Format\CornerMask|none
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set the mask
     * @param \Urbania\AppleNews\Format\CornerMask|array|none $mask
     * @return $this
     */
    public function setMask($mask)
    {
        if (is_null($mask)) {
            $this->mask = null;
            return $this;
        }

        if (is_object($mask) || Utils::isAssociativeArray($mask)) {
            Assert::isSdkObject($mask, CornerMask::class);
        } else {
            Assert::eq($mask, 'none');
        }

        $this->mask = Utils::isAssociativeArray($mask) ? new CornerMask($mask) : $mask;
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
     * Get the shadow
     * @return \Urbania\AppleNews\Format\ComponentShadow
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Set the shadow
     * @param \Urbania\AppleNews\Format\ComponentShadow|array $shadow
     * @return $this
     */
    public function setShadow($shadow)
    {
        if (is_null($shadow)) {
            $this->shadow = null;
            return $this;
        }

        Assert::isSdkObject($shadow, ComponentShadow::class);

        $this->shadow = Utils::isAssociativeArray($shadow) ? new ComponentShadow($shadow) : $shadow;
        return $this;
    }

    /**
     * Get the tableStyle
     * @return \Urbania\AppleNews\Format\TableStyle|none
     */
    public function getTableStyle()
    {
        return $this->tableStyle;
    }

    /**
     * Set the tableStyle
     * @param \Urbania\AppleNews\Format\TableStyle|array|none $tableStyle
     * @return $this
     */
    public function setTableStyle($tableStyle)
    {
        if (is_null($tableStyle)) {
            $this->tableStyle = null;
            return $this;
        }

        if (is_object($tableStyle) || Utils::isAssociativeArray($tableStyle)) {
            Assert::isSdkObject($tableStyle, TableStyle::class);
        } else {
            Assert::eq($tableStyle, 'none');
        }

        $this->tableStyle = Utils::isAssociativeArray($tableStyle)
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
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
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
                $this->border instanceof Arrayable ? $this->border->toArray() : $this->border;
        }
        if (isset($this->fill)) {
            $data['fill'] = $this->fill instanceof Arrayable ? $this->fill->toArray() : $this->fill;
        }
        if (isset($this->mask)) {
            $data['mask'] = $this->mask instanceof Arrayable ? $this->mask->toArray() : $this->mask;
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
        if (isset($this->shadow)) {
            $data['shadow'] =
                $this->shadow instanceof Arrayable ? $this->shadow->toArray() : $this->shadow;
        }
        return $data;
    }
}
