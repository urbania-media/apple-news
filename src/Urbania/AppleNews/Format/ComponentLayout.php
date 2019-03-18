<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the positioning for a specific component
 * within the article’s column system.
 *
 * @see https://developer.apple.com/documentation/apple_news/componentlayout
 */
class ComponentLayout
{
    /**
     * Indicates how many columns the component spans, based on the number of
     * columns in the document.
     * @var integer
     */
    protected $columnSpan;

    /**
     * Indicates which column the component‘s start position is in, based
     * on the number of columns in the document or parent container.
     * @var integer
     */
    protected $columnStart;

    /**
     * Defines a content inset for the component. If applied, the inset will
     * be equivalent to half the document gutter. For example, if the
     * article’s layout sets the document gutter to 40pt, the content inset
     * will be 20 points. See Layout.
     * @var \Urbania\AppleNews\Format\ContentInset|boolean
     */
    protected $contentInset;

    /**
     * Sets the alignment of the content within the component. This property
     * applies only when the width of the content is less than the width of
     * the component.
     * @var string
     */
    protected $horizontalContentAlignment;

    /**
     * Indicates whether the gutters (if any) to the left and right of the
     * component should be ignored. The gutter size is defined in the Layout
     * object at the root level of the document. Use this option if you want
     * to position two components right next to each other without a gutter
     * between them. This property applies only when a gutter actually exists
     * to the left or right of the component. The first column does not have
     * a left gutter, and the last column does not have a right gutter.
     * @var boolean|string
     */
    protected $ignoreDocumentGutter;

    /**
     * Indicates whether a document’s margins should be respected or
     * ignored by the parent container. Ignoring document margins will
     * position the component at the edge of the display. This property
     * affects the layout only if the component is in the first or last
     * column.
     * @var boolean|string
     */
    protected $ignoreDocumentMargin;

    /**
     * Sets the margins for the top and bottom of the component, as a single
     * integer that gets applied to the top and bottom margins, or as an
     * object containing separate properties for top and bottom.
     * @var \Urbania\AppleNews\Format\Margin|integer
     */
    protected $margin;

    /**
     * Sets the maximum width of the content within the component. Specify
     * this value as an integer in points or using one of the available units
     * of measure for components. See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $maximumContentWidth;

    /**
     * Sets the minimum height of the component. A component will be taller
     * than its defined minimumHeight when the contents require the component
     * to be taller. The minimum height can be defined as an integer in
     * points or using one of the available units of measure for components.
     * See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $minimumHeight;

    public function __construct(array $data = [])
    {
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

        if (isset($data['minimumHeight'])) {
            $this->setMinimumHeight($data['minimumHeight']);
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
     * Get the columnStart
     * @return integer
     */
    public function getColumnStart()
    {
        return $this->columnStart;
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
     * Get the horizontalContentAlignment
     * @return string
     */
    public function getHorizontalContentAlignment()
    {
        return $this->horizontalContentAlignment;
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
     * Get the ignoreDocumentMargin
     * @return boolean|string
     */
    public function getIgnoreDocumentMargin()
    {
        return $this->ignoreDocumentMargin;
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
     * Get the maximumContentWidth
     * @return string|integer
     */
    public function getMaximumContentWidth()
    {
        return $this->maximumContentWidth;
    }

    /**
     * Get the minimumHeight
     * @return string|integer
     */
    public function getMinimumHeight()
    {
        return $this->minimumHeight;
    }

    /**
     * Set the columnSpan
     * @param integer $columnSpan
     * @return $this
     */
    public function setColumnSpan($columnSpan)
    {
        Assert::integer($columnSpan);

        $this->columnSpan = $columnSpan;
        return $this;
    }

    /**
     * Set the columnStart
     * @param integer $columnStart
     * @return $this
     */
    public function setColumnStart($columnStart)
    {
        Assert::integer($columnStart);

        $this->columnStart = $columnStart;
        return $this;
    }

    /**
     * Set the contentInset
     * @param \Urbania\AppleNews\Format\ContentInset|array|boolean $contentInset
     * @return $this
     */
    public function setContentInset($contentInset)
    {
        if (is_object($contentInset)) {
            Assert::isInstanceOf($contentInset, ContentInset::class);
        } elseif (!is_array($contentInset)) {
            Assert::boolean($contentInset);
        }

        $this->contentInset = is_array($contentInset)
            ? new ContentInset($contentInset)
            : $contentInset;
        return $this;
    }

    /**
     * Set the horizontalContentAlignment
     * @param string $horizontalContentAlignment
     * @return $this
     */
    public function setHorizontalContentAlignment($horizontalContentAlignment)
    {
        Assert::oneOf($horizontalContentAlignment, ["left", "center", "right"]);

        $this->horizontalContentAlignment = $horizontalContentAlignment;
        return $this;
    }

    /**
     * Set the ignoreDocumentGutter
     * @param boolean|string $ignoreDocumentGutter
     * @return $this
     */
    public function setIgnoreDocumentGutter($ignoreDocumentGutter)
    {
        Assert::oneOf($ignoreDocumentGutter, [
            true,
            false,
            "none",
            "left",
            "right",
            "both"
        ]);

        $this->ignoreDocumentGutter = $ignoreDocumentGutter;
        return $this;
    }

    /**
     * Set the ignoreDocumentMargin
     * @param boolean|string $ignoreDocumentMargin
     * @return $this
     */
    public function setIgnoreDocumentMargin($ignoreDocumentMargin)
    {
        Assert::oneOf($ignoreDocumentMargin, [
            true,
            false,
            "none",
            "left",
            "right",
            "both"
        ]);

        $this->ignoreDocumentMargin = $ignoreDocumentMargin;
        return $this;
    }

    /**
     * Set the margin
     * @param \Urbania\AppleNews\Format\Margin|array|integer $margin
     * @return $this
     */
    public function setMargin($margin)
    {
        if (is_object($margin)) {
            Assert::isInstanceOf($margin, Margin::class);
        } elseif (!is_array($margin)) {
            Assert::integer($margin);
        }

        $this->margin = is_array($margin) ? new Margin($margin) : $margin;
        return $this;
    }

    /**
     * Set the maximumContentWidth
     * @param string|integer $maximumContentWidth
     * @return $this
     */
    public function setMaximumContentWidth($maximumContentWidth)
    {
        Assert::isSupportedUnits($maximumContentWidth);

        $this->maximumContentWidth = $maximumContentWidth;
        return $this;
    }

    /**
     * Set the minimumHeight
     * @param string|integer $minimumHeight
     * @return $this
     */
    public function setMinimumHeight($minimumHeight)
    {
        Assert::isSupportedUnits($minimumHeight);

        $this->minimumHeight = $minimumHeight;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        if (isset($this->columnSpan)) {
            $data['columnSpan'] = $this->columnSpan;
        }
        if (isset($this->columnStart)) {
            $data['columnStart'] = $this->columnStart;
        }
        if (isset($this->contentInset)) {
            $data['contentInset'] = is_object($this->contentInset)
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
            $data['margin'] = is_object($this->margin)
                ? $this->margin->toArray()
                : $this->margin;
        }
        if (isset($this->maximumContentWidth)) {
            $data['maximumContentWidth'] = is_object($this->maximumContentWidth)
                ? $this->maximumContentWidth->toArray()
                : $this->maximumContentWidth;
        }
        if (isset($this->minimumHeight)) {
            $data['minimumHeight'] = is_object($this->minimumHeight)
                ? $this->minimumHeight->toArray()
                : $this->minimumHeight;
        }
        return $data;
    }
}
