<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object that allows you to specify the minimum and maximum
 * dimensions for images in data table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/imagedataformat
 */
class ImageDataFormat extends DataFormat
{
    /**
     * The maximum height of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var string|integer
     */
    protected $maximumHeight;

    /**
     * The maximum width of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var string|integer
     */
    protected $maximumWidth;

    /**
     * The minimum height of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var string|integer
     */
    protected $minimumHeight;

    /**
     * The minimum width of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var string|integer
     */
    protected $minimumWidth;

    /**
     * The type of data format for this object. This must be image for an
     * ImageDataFormat object.
     * @var string
     */
    protected $type = 'image';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['maximumHeight'])) {
            $this->setMaximumHeight($data['maximumHeight']);
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
    }

    /**
     * Get the maximumHeight
     * @return string|integer
     */
    public function getMaximumHeight()
    {
        return $this->maximumHeight;
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
     * Get the minimumHeight
     * @return string|integer
     */
    public function getMinimumHeight()
    {
        return $this->minimumHeight;
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
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the maximumHeight
     * @param string|integer $maximumHeight
     * @return $this
     */
    public function setMaximumHeight($maximumHeight)
    {
        Assert::isSupportedUnits($maximumHeight);

        $this->maximumHeight = $maximumHeight;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'maximumHeight' => is_object($this->maximumHeight)
                ? $this->maximumHeight->toArray()
                : $this->maximumHeight,
            'maximumWidth' => is_object($this->maximumWidth)
                ? $this->maximumWidth->toArray()
                : $this->maximumWidth,
            'minimumHeight' => is_object($this->minimumHeight)
                ? $this->minimumHeight->toArray()
                : $this->minimumHeight,
            'minimumWidth' => is_object($this->minimumWidth)
                ? $this->minimumWidth->toArray()
                : $this->minimumWidth,
            'type' => $this->type
        ]);
    }
}
