<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * An object used in any container component type to define how the
 * collection of child components is presented.
 *
 * @see https://developer.apple.com/documentation/apple_news/collectiondisplay
 */
class CollectionDisplay
{
    /**
     * Defines how components are aligned within their rows. This is
     * especially visible when distribution is set to narrow.
     * @var string
     */
    protected $alignment;

    /**
     * Describes how components should be distributed horizontally in a row.
     * @var string
     */
    protected $distribution;

    /**
     * Either a number in points or a string referring to a supported unit of
     * measure defining the vertical gutter between components.
     * @var string|integer
     */
    protected $gutter;

    /**
     * Either a number in points or a string referring to a supported unit of
     * measure defining the maximum width of each child component inside the
     * collection.
     * @var string|integer
     */
    protected $maximumWidth;

    /**
     * Either a number in points or a string referring to a supported unit of
     * measure defining the minimum width of each child component inside the
     * collection.
     * @var string|integer
     */
    protected $minimumWidth;

    /**
     * Either a number in points or a string referring to a supported unit of
     * measure defining the horizontal spacing between rows. See Specifying
     * Measurements for Components.
     * @var string|integer
     */
    protected $rowSpacing;

    /**
     * Should be set to collection.
     * @var string
     */
    protected $type = 'collection';

    /**
     * Defines whether the components’ area is allowed to be sized
     * differently per row.
     * @var boolean
     */
    protected $variableSizing;

    /**
     * Defines the approach to prevent the collection from having component
     * widows.
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
     * Get the distribution
     * @return string
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * Get the gutter
     * @return string|integer
     */
    public function getGutter()
    {
        return $this->gutter;
    }

    /**
     * Get the maximumWidth
     * @return string|integer
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
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
     * Get the rowSpacing
     * @return string|integer
     */
    public function getRowSpacing()
    {
        return $this->rowSpacing;
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
     * Get the widows
     * @return string
     */
    public function getWidows()
    {
        return $this->widows;
    }

    /**
     * Set the alignment
     * @param string $alignment
     * @return $this
     */
    public function setAlignment($alignment)
    {
        Assert::oneOf($alignment, ["left", "center", "right"]);

        $this->alignment = $alignment;
        return $this;
    }

    /**
     * Set the distribution
     * @param string $distribution
     * @return $this
     */
    public function setDistribution($distribution)
    {
        Assert::oneOf($distribution, ["wide", "narrow"]);

        $this->distribution = $distribution;
        return $this;
    }

    /**
     * Set the gutter
     * @param string|integer $gutter
     * @return $this
     */
    public function setGutter($gutter)
    {
        Assert::isSupportedUnits($gutter);

        $this->gutter = $gutter;
        return $this;
    }

    /**
     * Set the maximumWidth
     * @param string|integer $maximumWidth
     * @return $this
     */
    public function setMaximumWidth($maximumWidth)
    {
        Assert::isSupportedUnits($maximumWidth);

        $this->maximumWidth = $maximumWidth;
        return $this;
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
     * Set the rowSpacing
     * @param string|integer $rowSpacing
     * @return $this
     */
    public function setRowSpacing($rowSpacing)
    {
        Assert::isSupportedUnits($rowSpacing);

        $this->rowSpacing = $rowSpacing;
        return $this;
    }

    /**
     * Set the variableSizing
     * @param boolean $variableSizing
     * @return $this
     */
    public function setVariableSizing($variableSizing)
    {
        Assert::boolean($variableSizing);

        $this->variableSizing = $variableSizing;
        return $this;
    }

    /**
     * Set the widows
     * @param string $widows
     * @return $this
     */
    public function setWidows($widows)
    {
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
        return [
            'alignment' => $this->alignment,
            'distribution' => $this->distribution,
            'gutter' => is_object($this->gutter)
                ? $this->gutter->toArray()
                : $this->gutter,
            'maximumWidth' => is_object($this->maximumWidth)
                ? $this->maximumWidth->toArray()
                : $this->maximumWidth,
            'minimumWidth' => is_object($this->minimumWidth)
                ? $this->minimumWidth->toArray()
                : $this->minimumWidth,
            'rowSpacing' => is_object($this->rowSpacing)
                ? $this->rowSpacing->toArray()
                : $this->rowSpacing,
            'type' => $this->type,
            'variableSizing' => $this->variableSizing,
            'widows' => $this->widows
        ];
    }
}
