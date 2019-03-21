<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
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
     * Set the maximumHeight
     * @param string|integer $maximumHeight
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
     * @return string|integer
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
    }

    /**
     * Set the maximumWidth
     * @param string|integer $maximumWidth
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
     * @return string|integer
     */
    public function getMinimumHeight()
    {
        return $this->minimumHeight;
    }

    /**
     * Set the minimumHeight
     * @param string|integer $minimumHeight
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
     * @return string|integer
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * Set the minimumWidth
     * @param string|integer $minimumWidth
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
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
