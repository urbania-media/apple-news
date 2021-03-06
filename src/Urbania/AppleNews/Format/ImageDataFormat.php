<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object that allows you to specify the minimum and maximum
 * dimensions for images in data table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/imagedataformat
 */
class ImageDataFormat extends DataFormat
{
    /**
     * Always image for an ImageDataFormat object.
     * @var string
     */
    protected $type = 'image';

    /**
     * The maximum height of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var integer|string
     */
    protected $maximumHeight;

    /**
     * The maximum width of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var integer|string
     */
    protected $maximumWidth;

    /**
     * The minimum height of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var integer|string
     */
    protected $minimumHeight;

    /**
     * The minimum width of an image in a cell as an integer in points or as
     * one of the available units for components.
     * @var integer|string
     */
    protected $minimumWidth;

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
     * @return integer|string
     */
    public function getMaximumHeight()
    {
        return $this->maximumHeight;
    }

    /**
     * Set the maximumHeight
     * @param integer|string $maximumHeight
     * @return $this
     */
    public function setMaximumHeight($maximumHeight)
    {
        if (is_null($maximumHeight)) {
            $this->maximumHeight = null;
            return $this;
        }

        Assert::isSupportedUnits($maximumHeight);

        $this->maximumHeight = $maximumHeight;
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
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->maximumHeight)) {
            $data['maximumHeight'] =
                $this->maximumHeight instanceof Arrayable
                    ? $this->maximumHeight->toArray()
                    : $this->maximumHeight;
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
        return $data;
    }
}
