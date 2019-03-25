<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * An object used in any container component type to define how the
 * collection of child components is presented.
 *
 * @see https://developer.apple.com/documentation/apple_news/collectiondisplay
 */
class CollectionDisplay extends BaseSdkObject
{
    /**
     * Always collection for this object.
     * @var string
     */
    protected $type = 'collection';

    /**
     * A string that defines how components are aligned within their rows.
     * This is especially visible when distribution is set to narrow.
     * @var string
     */
    protected $alignment;

    /**
     * A string that defines how components should be distributed
     * horizontally in a row.
     * @var string
     */
    protected $distribution;

    /**
     * A number in points or a string referring to a supported unit of
     * measure defining the vertical gutter between components.
     * @var integer|string
     */
    protected $gutter;

    /**
     * A number in points or a string referring to a supported unit of
     * measure defining the maximum width of each child component inside the
     * collection.
     * @var integer|string
     */
    protected $maximumWidth;

    /**
     * A number in points or a string referring to a supported unit of
     * measure defining the minimum width of each child component inside the
     * collection.
     * @var integer|string
     */
    protected $minimumWidth;

    /**
     * A number in points or a string referring to a supported unit of
     * measure defining the horizontal spacing between rows. See Specifying
     * Measurements for Components.
     * @var integer|string
     */
    protected $rowSpacing;

    /**
     * A Boolean value that defines whether the components’ area is allowed
     * to be sized differently per row.
     * @var boolean
     */
    protected $variableSizing;

    /**
     * A string that defines the approach to prevent the collection from
     * having component widows.
     * @var string
     */
    protected $widows;

    public function __construct(array $data = [])
    {
        if (isset($data['alignment'])) {
            $this->setAlignment($data['alignment']);
        }

        if (isset($data['distribution'])) {
            $this->setDistribution($data['distribution']);
        }

        if (isset($data['gutter'])) {
            $this->setGutter($data['gutter']);
        }

        if (isset($data['maximumWidth'])) {
            $this->setMaximumWidth($data['maximumWidth']);
        }

        if (isset($data['minimumWidth'])) {
            $this->setMinimumWidth($data['minimumWidth']);
        }

        if (isset($data['rowSpacing'])) {
            $this->setRowSpacing($data['rowSpacing']);
        }

        if (isset($data['variableSizing'])) {
            $this->setVariableSizing($data['variableSizing']);
        }

        if (isset($data['widows'])) {
            $this->setWidows($data['widows']);
        }
    }

    /**
     * Get the alignment
     * @return string
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Set the alignment
     * @param string $alignment
     * @return $this
     */
    public function setAlignment($alignment)
    {
        if (is_null($alignment)) {
            $this->alignment = null;
            return $this;
        }

        Assert::oneOf($alignment, ["left", "center", "right"]);

        $this->alignment = $alignment;
        return $this;
    }

    /**
     * Get the distribution
     * @return string
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * Set the distribution
     * @param string $distribution
     * @return $this
     */
    public function setDistribution($distribution)
    {
        if (is_null($distribution)) {
            $this->distribution = null;
            return $this;
        }

        Assert::oneOf($distribution, ["wide", "narrow"]);

        $this->distribution = $distribution;
        return $this;
    }

    /**
     * Get the gutter
     * @return integer|string
     */
    public function getGutter()
    {
        return $this->gutter;
    }

    /**
     * Set the gutter
     * @param integer|string $gutter
     * @return $this
     */
    public function setGutter($gutter)
    {
        if (is_null($gutter)) {
            $this->gutter = null;
            return $this;
        }

        Assert::isSupportedUnits($gutter);

        $this->gutter = $gutter;
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
     * Get the rowSpacing
     * @return integer|string
     */
    public function getRowSpacing()
    {
        return $this->rowSpacing;
    }

    /**
     * Set the rowSpacing
     * @param integer|string $rowSpacing
     * @return $this
     */
    public function setRowSpacing($rowSpacing)
    {
        if (is_null($rowSpacing)) {
            $this->rowSpacing = null;
            return $this;
        }

        Assert::isSupportedUnits($rowSpacing);

        $this->rowSpacing = $rowSpacing;
        return $this;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the variableSizing
     * @return boolean
     */
    public function getVariableSizing()
    {
        return $this->variableSizing;
    }

    /**
     * Set the variableSizing
     * @param boolean $variableSizing
     * @return $this
     */
    public function setVariableSizing($variableSizing)
    {
        if (is_null($variableSizing)) {
            $this->variableSizing = null;
            return $this;
        }

        Assert::boolean($variableSizing);

        $this->variableSizing = $variableSizing;
        return $this;
    }

    /**
     * Get the widows
     * @return string
     */
    public function getWidows()
    {
        return $this->widows;
    }

    /**
     * Set the widows
     * @param string $widows
     * @return $this
     */
    public function setWidows($widows)
    {
        if (is_null($widows)) {
            $this->widows = null;
            return $this;
        }

        Assert::oneOf($widows, ["equalize", "optimize"]);

        $this->widows = $widows;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->alignment)) {
            $data['alignment'] = $this->alignment;
        }
        if (isset($this->distribution)) {
            $data['distribution'] = $this->distribution;
        }
        if (isset($this->gutter)) {
            $data['gutter'] =
                $this->gutter instanceof Arrayable
                    ? $this->gutter->toArray()
                    : $this->gutter;
        }
        if (isset($this->maximumWidth)) {
            $data['maximumWidth'] =
                $this->maximumWidth instanceof Arrayable
                    ? $this->maximumWidth->toArray()
                    : $this->maximumWidth;
        }
        if (isset($this->minimumWidth)) {
            $data['minimumWidth'] =
                $this->minimumWidth instanceof Arrayable
                    ? $this->minimumWidth->toArray()
                    : $this->minimumWidth;
        }
        if (isset($this->rowSpacing)) {
            $data['rowSpacing'] =
                $this->rowSpacing instanceof Arrayable
                    ? $this->rowSpacing->toArray()
                    : $this->rowSpacing;
        }
        if (isset($this->variableSizing)) {
            $data['variableSizing'] = $this->variableSizing;
        }
        if (isset($this->widows)) {
            $data['widows'] = $this->widows;
        }
        return $data;
    }
}
