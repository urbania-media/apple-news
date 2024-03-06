<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the positioning for a specific component
 * within the article’s column system.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/componentlayout.json
 */
class ComponentLayout extends BaseSdkObject
{
    /**
     * A number that indicates how many columns the component spans, based on
     * the number of columns in the document.
     * By default, the component spans the entire width of the document or
     * the width of its container component.
     * @var integer
     */
    protected $columnSpan;

    /**
     * A number that indicates which column the component‘s start position
     * is in, based on the number of columns in the document or parent
     * container.
     * By default, the component starts in the first column (note that the
     * first column is 0, not 1).
     * @var integer
     */
    protected $columnStart;

    /**
     * An instance or array of component layout properties that can be
     * applied conditionally, and the conditions that cause them to be
     * applied.
     * @var Format\ConditionalComponentLayout[]|\Urbania\AppleNews\Format\ConditionalComponentLayout
     */
    protected $conditional;

    /**
     * A string value that sets the alignment of the content within the
     * component. This property applies only when the width of the content is
     * less than the width of the component.
     * This property is supported for , , , , and . All other components
     * ignore this property.
     * @var string
     */
    protected $horizontalContentAlignment;

    /**
     * A value that indicates whether the gutters (if any) to the left and
     * right of the component should be ignored. The gutter size is defined
     * in the Layout object at the root level of the document.
     * Use this option if you want to position two components right next to
     * each other without a gutter between them. This property applies only
     * when a gutter actually exists to the left or right of the component.
     * The first column does not have a left gutter, and the last column does
     * not have a right gutter.
     * Valid values:
     * You can also set this property to true to indicate that both gutters
     * should be ignored, or set it to false to ignore none of the gutters.
     * By default, none of the gutters are ignored.
     * @var boolean|string
     */
    protected $ignoreDocumentGutter;

    /**
     * A value that indicates whether the component should respect or ignore
     * the document’s margins. Ignoring document margins positions the
     * component based on the document's width and margin.
     * Valid values:
     * Instead of specifying margins, you can set this property to true to
     * indicate that both margins should be ignored, or set it to false to
     * ignore neither of the margins. By default, neither margin is  ignored.
     *
     * The layout of a parent component will always constrain any child
     * components. As such, setting ignoreDocumentMargin to true for a
     * component will have no effect if it is inside of a container with
     * ignoreDocumentMargin set to false.
     * Specifying a value other than none for ignoreViewportPadding will take
     * precedence over any value defined for ignoreDocumentMargin.
     * On a device with screen size wider than the document width and margin
     * combined, a component with ignoreDocumentMargin property set to true
     * will extend the width of the document plus the margin, but will not
     * extend into the viewport padding.
     * @var boolean|string
     */
    protected $ignoreDocumentMargin;

    /**
     * A value that indicates whether the component should respect or ignore
     * the viewport padding. Ignoring viewport padding positions the
     * component at the edge of the display screen. This property affects the
     * layout only if the component is in the first or last column.
     * Valid values:
     * Instead of specifying padding, you can set this property to true to
     * indicate that paddings on both sides should be ignored, or set it to
     * false to ignore neither padding. By default, neither padding is
     * ignored.
     * The layout of a parent component will always constrain any child
     * components. Setting ignoreViewportPadding to true for a component will
     * have no effect if it is inside of a container with
     * ignoreViewportPadding set to false.
     * If ignoreViewportPadding is set to true, left, right, or both it
     * overrides the layout’s ignoreDocumentMargin value and spans the
     * entire screen.
     * If ignoreViewportPadding is set to none, the value of
     * ignoreDocumentMargin is accepted.
     * By default, components do not ignore the viewport padding, even if you
     * previously specified ignoreDocumentMargin to span the entire width of
     * the screen. To achieve the same functionality, you must update your
     * article to use ignoreViewportPadding.
     * @var boolean|string
     */
    protected $ignoreViewportPadding;

    /**
     * A value that sets the margins for the top and bottom of the component,
     * as a single integer that gets applied to the top and bottom margins,
     * or as an object containing separate properties for top and bottom.
     * @var \Urbania\AppleNews\Format\Margin|integer
     */
    protected $margin;

    /**
     * A value that sets the maximum width of the content within the
     * component. Specify this value as a number in points or using one of
     * the available units of measure for components. See .
     * This property is supported for , ,, , and . All other components
     * ignore this property.
     * @var string|integer|float
     */
    protected $maximumContentWidth;

    /**
     * A value that sets the minimum height of the component. A component is
     * taller than its defined minimumHeight when the contents require the
     * component to be taller. The minimum height can be defined as a number
     * in points or using one of the available units of measure for
     * components. See .
     * @var string|integer|float
     */
    protected $minimumHeight;

    /**
     * A value that defines the minimum width of the layout when used within
     * a  with  as the specified contentDisplay type. The minimum width can
     * be defined as a number in points or using one of the available units
     * of measure for components. See .
     * @var string|integer|float
     */
    protected $minimumWidth;

    /**
     * A value that defines the maximum width of the layout when used within
     * a  with  as the specified contentDisplay type. The maximum width can
     * be defined as a number in points or using one of the available units
     * of measure for components. See .
     * @var string|integer|float
     */
    protected $maximumWidth;

    /**
     * A value that defines the padding between the content of the component
     * and the edges of the component. Padding can be defined as a number in
     * points or using one of the available units of measure for components.
     * See .
     * @var \Urbania\AppleNews\Format\Padding|string|integer|float
     */
    protected $padding;

    public function __construct(array $data = [])
    {
        if (isset($data['columnSpan'])) {
            $this->setColumnSpan($data['columnSpan']);
        }

        if (isset($data['columnStart'])) {
            $this->setColumnStart($data['columnStart']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['horizontalContentAlignment'])) {
            $this->setHorizontalContentAlignment($data['horizontalContentAlignment']);
        }

        if (isset($data['ignoreDocumentGutter'])) {
            $this->setIgnoreDocumentGutter($data['ignoreDocumentGutter']);
        }

        if (isset($data['ignoreDocumentMargin'])) {
            $this->setIgnoreDocumentMargin($data['ignoreDocumentMargin']);
        }

        if (isset($data['ignoreViewportPadding'])) {
            $this->setIgnoreViewportPadding($data['ignoreViewportPadding']);
        }

        if (isset($data['margin'])) {
            $this->setMargin($data['margin']);
        }

        if (isset($data['maximumContentWidth'])) {
            $this->setMaximumContentWidth($data['maximumContentWidth']);
        }

        if (isset($data['minimumHeight'])) {
            $this->setMinimumHeight($data['minimumHeight']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
        }

        if (isset($data['maximumWidth'])) {
            $this->setMaximumWidth($data['maximumWidth']);
        }

        if (isset($data['padding'])) {
            $this->setPadding($data['padding']);
        }
    }

    /**
     * Get the columnSpan
     * @return integer
     */
    public function getColumnSpan()
    {
        return $this->columnSpan;
    }

    /**
     * Set the columnSpan
     * @param integer $columnSpan
     * @return $this
     */
    public function setColumnSpan($columnSpan)
    {
        if (is_null($columnSpan)) {
            $this->columnSpan = null;
            return $this;
        }

        Assert::integer($columnSpan);

        $this->columnSpan = $columnSpan;
        return $this;
    }

    /**
     * Get the columnStart
     * @return integer
     */
    public function getColumnStart()
    {
        return $this->columnStart;
    }

    /**
     * Set the columnStart
     * @param integer $columnStart
     * @return $this
     */
    public function setColumnStart($columnStart)
    {
        if (is_null($columnStart)) {
            $this->columnStart = null;
            return $this;
        }

        Assert::integer($columnStart);

        $this->columnStart = $columnStart;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalComponentLayout[]|\Urbania\AppleNews\Format\ConditionalComponentLayout
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalComponentLayout[]|\Urbania\AppleNews\Format\ConditionalComponentLayout|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalComponentLayout::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalComponentLayout::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalComponentLayout($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the horizontalContentAlignment
     * @return string
     */
    public function getHorizontalContentAlignment()
    {
        return $this->horizontalContentAlignment;
    }

    /**
     * Set the horizontalContentAlignment
     * @param string $horizontalContentAlignment
     * @return $this
     */
    public function setHorizontalContentAlignment($horizontalContentAlignment)
    {
        if (is_null($horizontalContentAlignment)) {
            $this->horizontalContentAlignment = null;
            return $this;
        }

        Assert::oneOf($horizontalContentAlignment, ['left', 'center', 'right']);

        $this->horizontalContentAlignment = $horizontalContentAlignment;
        return $this;
    }

    /**
     * Get the ignoreDocumentGutter
     * @return boolean|string
     */
    public function getIgnoreDocumentGutter()
    {
        return $this->ignoreDocumentGutter;
    }

    /**
     * Set the ignoreDocumentGutter
     * @param boolean|string $ignoreDocumentGutter
     * @return $this
     */
    public function setIgnoreDocumentGutter($ignoreDocumentGutter)
    {
        if (is_null($ignoreDocumentGutter)) {
            $this->ignoreDocumentGutter = null;
            return $this;
        }

        Assert::oneOf($ignoreDocumentGutter, ['none', 'left', 'right', 'both', true, false]);

        $this->ignoreDocumentGutter = $ignoreDocumentGutter;
        return $this;
    }

    /**
     * Get the ignoreDocumentMargin
     * @return boolean|string
     */
    public function getIgnoreDocumentMargin()
    {
        return $this->ignoreDocumentMargin;
    }

    /**
     * Set the ignoreDocumentMargin
     * @param boolean|string $ignoreDocumentMargin
     * @return $this
     */
    public function setIgnoreDocumentMargin($ignoreDocumentMargin)
    {
        if (is_null($ignoreDocumentMargin)) {
            $this->ignoreDocumentMargin = null;
            return $this;
        }

        Assert::oneOf($ignoreDocumentMargin, ['none', 'left', 'right', 'both', true, false]);

        $this->ignoreDocumentMargin = $ignoreDocumentMargin;
        return $this;
    }

    /**
     * Get the ignoreViewportPadding
     * @return boolean|string
     */
    public function getIgnoreViewportPadding()
    {
        return $this->ignoreViewportPadding;
    }

    /**
     * Set the ignoreViewportPadding
     * @param boolean|string $ignoreViewportPadding
     * @return $this
     */
    public function setIgnoreViewportPadding($ignoreViewportPadding)
    {
        if (is_null($ignoreViewportPadding)) {
            $this->ignoreViewportPadding = null;
            return $this;
        }

        Assert::oneOf($ignoreViewportPadding, ['none', 'left', 'right', 'both', true, false]);

        $this->ignoreViewportPadding = $ignoreViewportPadding;
        return $this;
    }

    /**
     * Get the margin
     * @return \Urbania\AppleNews\Format\Margin|integer
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * Set the margin
     * @param \Urbania\AppleNews\Format\Margin|array|integer $margin
     * @return $this
     */
    public function setMargin($margin)
    {
        if (is_null($margin)) {
            $this->margin = null;
            return $this;
        }

        if (is_object($margin) || Utils::isAssociativeArray($margin)) {
            Assert::isSdkObject($margin, Margin::class);
        } else {
            Assert::integer($margin);
        }

        $this->margin = Utils::isAssociativeArray($margin) ? new Margin($margin) : $margin;
        return $this;
    }

    /**
     * Get the maximumContentWidth
     * @return string|integer|float
     */
    public function getMaximumContentWidth()
    {
        return $this->maximumContentWidth;
    }

    /**
     * Set the maximumContentWidth
     * @param string|integer|float $maximumContentWidth
     * @return $this
     */
    public function setMaximumContentWidth($maximumContentWidth)
    {
        if (is_null($maximumContentWidth)) {
            $this->maximumContentWidth = null;
            return $this;
        }

        Assert::isSupportedUnits($maximumContentWidth);

        $this->maximumContentWidth = $maximumContentWidth;
        return $this;
    }

    /**
     * Get the maximumWidth
     * @return string|integer|float
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
    }

    /**
     * Set the maximumWidth
     * @param string|integer|float $maximumWidth
     * @return $this
     */
    public function setMaximumWidth($maximumWidth)
    {
        if (is_null($maximumWidth)) {
            $this->maximumWidth = null;
            return $this;
        }

        Assert::isSupportedUnits($maximumWidth);

        $this->maximumWidth = $maximumWidth;
        return $this;
    }

    /**
     * Get the minimumHeight
     * @return string|integer|float
     */
    public function getMinimumHeight()
    {
        return $this->minimumHeight;
    }

    /**
     * Set the minimumHeight
     * @param string|integer|float $minimumHeight
     * @return $this
     */
    public function setMinimumHeight($minimumHeight)
    {
        if (is_null($minimumHeight)) {
            $this->minimumHeight = null;
            return $this;
        }

        Assert::isSupportedUnits($minimumHeight);

        $this->minimumHeight = $minimumHeight;
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
     * Get the padding
     * @return \Urbania\AppleNews\Format\Padding|string|integer|float
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Set the padding
     * @param \Urbania\AppleNews\Format\Padding|array|string|integer|float $padding
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

        $this->padding = Utils::isAssociativeArray($padding) ? new Padding($padding) : $padding;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->columnSpan)) {
            $data['columnSpan'] = $this->columnSpan;
        }
        if (isset($this->columnStart)) {
            $data['columnStart'] = $this->columnStart;
        }
        if (isset($this->conditional)) {
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
                    : $this->conditional;
        }
        if (isset($this->horizontalContentAlignment)) {
            $data['horizontalContentAlignment'] = $this->horizontalContentAlignment;
        }
        if (isset($this->ignoreDocumentGutter)) {
            $data['ignoreDocumentGutter'] = $this->ignoreDocumentGutter;
        }
        if (isset($this->ignoreDocumentMargin)) {
            $data['ignoreDocumentMargin'] = $this->ignoreDocumentMargin;
        }
        if (isset($this->ignoreViewportPadding)) {
            $data['ignoreViewportPadding'] = $this->ignoreViewportPadding;
        }
        if (isset($this->margin)) {
            $data['margin'] =
                $this->margin instanceof Arrayable ? $this->margin->toArray() : $this->margin;
        }
        if (isset($this->maximumContentWidth)) {
            $data['maximumContentWidth'] =
                $this->maximumContentWidth instanceof Arrayable
                    ? $this->maximumContentWidth->toArray()
                    : $this->maximumContentWidth;
        }
        if (isset($this->minimumHeight)) {
            $data['minimumHeight'] =
                $this->minimumHeight instanceof Arrayable
                    ? $this->minimumHeight->toArray()
                    : $this->minimumHeight;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] =
                $this->minimumWidth instanceof Arrayable
                    ? $this->minimumWidth->toArray()
                    : $this->minimumWidth;
        }
        if (isset($this->maximumWidth)) {
            $data['maximumWidth'] =
                $this->maximumWidth instanceof Arrayable
                    ? $this->maximumWidth->toArray()
                    : $this->maximumWidth;
        }
        if (isset($this->padding)) {
            $data['padding'] =
                $this->padding instanceof Arrayable ? $this->padding->toArray() : $this->padding;
        }
        return $data;
    }
}
