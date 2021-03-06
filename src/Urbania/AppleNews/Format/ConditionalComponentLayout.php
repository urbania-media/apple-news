<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining conditional properties for a component layout,
 * and when the conditional properties are in effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/conditionalcomponentlayout
 */
class ConditionalComponentLayout extends ComponentLayout
{
    /**
     * An array of conditions that, when met, cause the conditional component
     * layout properties to be in effect.
     * @var Format\Condition[]
     */
    protected $conditions;

    /**
     * A number that indicates how many columns the component spans, based on
     * the number of columns in the document.
     * @var integer
     */
    protected $columnSpan;

    /**
     * A number that indicates which column the component's start position is
     * in, based on the number of columns in the document or parent
     * container.
     * @var integer
     */
    protected $columnStart;

    /**
     * A value that defines a content inset for the component. If applied,
     * the inset is equivalent to half the document gutter. For example, if
     * the article's layout sets the document gutter to 40pt, the content
     * inset is 20 points.
     * @var \Urbania\AppleNews\Format\ContentInset|boolean
     */
    protected $contentInset;

    /**
     * The alignment of the content within the component. This property
     * applies only when the width of the content is less than the width of
     * the component.
     * @var string
     */
    protected $horizontalContentAlignment;

    /**
     * A value that indicates whether the gutters (if any) to the left and
     * right of the component should be ignored. The gutter size is defined
     * in the Layout object at the root level of the document.
     * @var boolean|string
     */
    protected $ignoreDocumentGutter;

    /**
     * A value that indicates whether a document’s margins should be
     * respected or ignored by the parent container. Ignoring document
     * margins positions the component at the edge of the display. This
     * property affects the layout only if the component is in the first or
     * last column.
     * @var boolean|string
     */
    protected $ignoreDocumentMargin;

    /**
     * The margins for the top and bottom of the component, as a single
     * integer that is applied to the top and bottom margins, or as an object
     * containing separate properties for top and bottom.
     * @var \Urbania\AppleNews\Format\Margin|integer
     */
    protected $margin;

    /**
     * The maximum width of the content within the component. Specify this
     * value as an integer in points, or use one of the available units of
     * measure for components. See Specifying Measurements for Components.
     * @var integer|string
     */
    protected $maximumContentWidth;

    /**
     * The maximum width of the layout when used within a Container with
     * HorizontalStackDisplay as the specified contentDisplay type.
     * @var integer|string
     */
    protected $maximumWidth;

    /**
     * The minimum height of the component. A component is taller than its
     * defined minimumHeight when the contents require it. Specify this value
     * as an integer in points, or use one of the available units of measure
     * for components. See Specifying Measurements for Components.
     * @var integer|string
     */
    protected $minimumHeight;

    /**
     * The minimum width of the layout when used within a container with
     * HorizontalStackDisplay as the specified contentDisplay type.
     * @var integer|string
     */
    protected $minimumWidth;

    /**
     * The padding between the content of the component and the edges of the
     * component.
     * @var \Urbania\AppleNews\Format\Padding|integer|string
     */
    protected $padding;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['conditions'])) {
            $this->setConditions($data['conditions']);
        }

        if (isset($data['columnSpan'])) {
            $this->setColumnSpan($data['columnSpan']);
        }

        if (isset($data['columnStart'])) {
            $this->setColumnStart($data['columnStart']);
        }

        if (isset($data['contentInset'])) {
            $this->setContentInset($data['contentInset']);
        }

        if (isset($data['horizontalContentAlignment'])) {
            $this->setHorizontalContentAlignment(
                $data['horizontalContentAlignment']
            );
        }

        if (isset($data['ignoreDocumentGutter'])) {
            $this->setIgnoreDocumentGutter($data['ignoreDocumentGutter']);
        }

        if (isset($data['ignoreDocumentMargin'])) {
            $this->setIgnoreDocumentMargin($data['ignoreDocumentMargin']);
        }

        if (isset($data['margin'])) {
            $this->setMargin($data['margin']);
        }

        if (isset($data['maximumContentWidth'])) {
            $this->setMaximumContentWidth($data['maximumContentWidth']);
        }

        if (isset($data['maximumWidth'])) {
            $this->setMaximumWidth($data['maximumWidth']);
        }

        if (isset($data['minimumHeight'])) {
            $this->setMinimumHeight($data['minimumHeight']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
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
     * Add an item to conditions
     * @param \Urbania\AppleNews\Format\Condition|array $item
     * @return $this
     */
    public function addCondition($item)
    {
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, [$item])
                : [$item]
        );
    }

    /**
     * Add items to conditions
     * @param array $items
     * @return $this
     */
    public function addConditions($items)
    {
        Assert::isArray($items);
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, $items)
                : $items
        );
    }

    /**
     * Get the conditions
     * @return Format\Condition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the conditions
     * @param Format\Condition[] $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        Assert::isArray($conditions);
        Assert::allIsSdkObject($conditions, Condition::class);

        $this->conditions = array_reduce(
            array_keys($conditions),
            function ($array, $key) use ($conditions) {
                $item = $conditions[$key];
                $array[$key] = is_array($item) ? new Condition($item) : $item;
                return $array;
            },
            []
        );
        return $this;
    }

    /**
     * Get the contentInset
     * @return \Urbania\AppleNews\Format\ContentInset|boolean
     */
    public function getContentInset()
    {
        return $this->contentInset;
    }

    /**
     * Set the contentInset
     * @param \Urbania\AppleNews\Format\ContentInset|array|boolean $contentInset
     * @return $this
     */
    public function setContentInset($contentInset)
    {
        if (is_null($contentInset)) {
            $this->contentInset = null;
            return $this;
        }

        if (is_object($contentInset) || is_array($contentInset)) {
            Assert::isSdkObject($contentInset, ContentInset::class);
        } else {
            Assert::boolean($contentInset);
        }

        $this->contentInset = is_array($contentInset)
            ? new ContentInset($contentInset)
            : $contentInset;
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

        Assert::oneOf($horizontalContentAlignment, ["left", "center", "right"]);

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

        Assert::oneOf($ignoreDocumentGutter, [
            "none",
            "left",
            "right",
            "both",
            true,
            false
        ]);

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

        Assert::oneOf($ignoreDocumentMargin, [
            "none",
            "left",
            "right",
            "both",
            true,
            false
        ]);

        $this->ignoreDocumentMargin = $ignoreDocumentMargin;
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

        if (is_object($margin) || is_array($margin)) {
            Assert::isSdkObject($margin, Margin::class);
        } else {
            Assert::integer($margin);
        }

        $this->margin = is_array($margin) ? new Margin($margin) : $margin;
        return $this;
    }

    /**
     * Get the maximumContentWidth
     * @return integer|string
     */
    public function getMaximumContentWidth()
    {
        return $this->maximumContentWidth;
    }

    /**
     * Set the maximumContentWidth
     * @param integer|string $maximumContentWidth
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
     * @return integer|string
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
    }

    /**
     * Set the maximumWidth
     * @param integer|string $maximumWidth
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
     * @return integer|string
     */
    public function getMinimumHeight()
    {
        return $this->minimumHeight;
    }

    /**
     * Set the minimumHeight
     * @param integer|string $minimumHeight
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
     * @return integer|string
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * Set the minimumWidth
     * @param integer|string $minimumWidth
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
     * @return \Urbania\AppleNews\Format\Padding|integer|string
     */
    public function getPadding()
    {
        return $this->padding;
    }

    /**
     * Set the padding
     * @param \Urbania\AppleNews\Format\Padding|array|integer|string $padding
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->conditions)) {
            $data['conditions'] = !is_null($this->conditions)
                ? array_reduce(
                    array_keys($this->conditions),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditions[$key] instanceof Arrayable
                                ? $this->conditions[$key]->toArray()
                                : $this->conditions[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditions;
        }
        if (isset($this->columnSpan)) {
            $data['columnSpan'] = $this->columnSpan;
        }
        if (isset($this->columnStart)) {
            $data['columnStart'] = $this->columnStart;
        }
        if (isset($this->contentInset)) {
            $data['contentInset'] =
                $this->contentInset instanceof Arrayable
                    ? $this->contentInset->toArray()
                    : $this->contentInset;
        }
        if (isset($this->horizontalContentAlignment)) {
            $data['horizontalContentAlignment'] =
                $this->horizontalContentAlignment;
        }
        if (isset($this->ignoreDocumentGutter)) {
            $data['ignoreDocumentGutter'] = $this->ignoreDocumentGutter;
        }
        if (isset($this->ignoreDocumentMargin)) {
            $data['ignoreDocumentMargin'] = $this->ignoreDocumentMargin;
        }
        if (isset($this->margin)) {
            $data['margin'] =
                $this->margin instanceof Arrayable
                    ? $this->margin->toArray()
                    : $this->margin;
        }
        if (isset($this->maximumContentWidth)) {
            $data['maximumContentWidth'] =
                $this->maximumContentWidth instanceof Arrayable
                    ? $this->maximumContentWidth->toArray()
                    : $this->maximumContentWidth;
        }
        if (isset($this->maximumWidth)) {
            $data['maximumWidth'] =
                $this->maximumWidth instanceof Arrayable
                    ? $this->maximumWidth->toArray()
                    : $this->maximumWidth;
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
        if (isset($this->padding)) {
            $data['padding'] =
                $this->padding instanceof Arrayable
                    ? $this->padding->toArray()
                    : $this->padding;
        }
        return $data;
    }
}
