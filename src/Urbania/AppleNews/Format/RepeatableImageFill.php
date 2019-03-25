<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for adding a background image that can be repeated.
 *
 * @see https://developer.apple.com/documentation/apple_news/repeatableimagefill
 */
class RepeatableImageFill extends Fill
{
    /**
     * Always repeatable_image for this object.
     * @var string
     */
    protected $type = 'repeatable_image';

    /**
     * The URL of the image file to use for filling the component.
     * @var string
     */
    protected $URL;

    /**
     * A string that indicates how the fill should behave when a user
     * scrolls.
     * @var string
     */
    protected $attachment;

    /**
     * The height of the image as it is repeated. When height is omitted, the
     * width property is used to determine the size based on the aspect ratio
     * of the provided image.
     * @var integer|string
     */
    protected $height;

    /**
     * A string that sets the horizontal alignment of the image fill within
     * its component.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * A string that defines the direction in which the background image is
     * repeated.
     * @var string
     */
    protected $repeat;

    /**
     * The vertical alignment of the repeatable image fill within its
     * component.
     * @var string
     */
    protected $verticalAlignment;

    /**
     * The width of the image as it is repeated. When width is omitted, the
     * height property is used to determine the size based on the aspect
     * ratio of the provided image.
     * @var integer|string
     */
    protected $width;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['attachment'])) {
            $this->setAttachment($data['attachment']);
        }

        if (isset($data['height'])) {
            $this->setHeight($data['height']);
        }

        if (isset($data['horizontalAlignment'])) {
            $this->setHorizontalAlignment($data['horizontalAlignment']);
        }

        if (isset($data['repeat'])) {
            $this->setRepeat($data['repeat']);
        }

        if (isset($data['verticalAlignment'])) {
            $this->setVerticalAlignment($data['verticalAlignment']);
        }

        if (isset($data['width'])) {
            $this->setWidth($data['width']);
        }
    }

    /**
     * Get the attachment
     * @return string
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set the attachment
     * @param string $attachment
     * @return $this
     */
    public function setAttachment($attachment)
    {
        if (is_null($attachment)) {
            $this->attachment = null;
            return $this;
        }

        Assert::oneOf($attachment, ["fixed", "scroll"]);

        $this->attachment = $attachment;
        return $this;
    }

    /**
     * Get the height
     * @return integer|string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the height
     * @param integer|string $height
     * @return $this
     */
    public function setHeight($height)
    {
        if (is_null($height)) {
            $this->height = null;
            return $this;
        }

        Assert::isSupportedUnits($height);

        $this->height = $height;
        return $this;
    }

    /**
     * Get the horizontalAlignment
     * @return string
     */
    public function getHorizontalAlignment()
    {
        return $this->horizontalAlignment;
    }

    /**
     * Set the horizontalAlignment
     * @param string $horizontalAlignment
     * @return $this
     */
    public function setHorizontalAlignment($horizontalAlignment)
    {
        if (is_null($horizontalAlignment)) {
            $this->horizontalAlignment = null;
            return $this;
        }

        Assert::oneOf($horizontalAlignment, ["left", "center", "right"]);

        $this->horizontalAlignment = $horizontalAlignment;
        return $this;
    }

    /**
     * Get the repeat
     * @return string
     */
    public function getRepeat()
    {
        return $this->repeat;
    }

    /**
     * Set the repeat
     * @param string $repeat
     * @return $this
     */
    public function setRepeat($repeat)
    {
        if (is_null($repeat)) {
            $this->repeat = null;
            return $this;
        }

        Assert::oneOf($repeat, ["none", "x", "y", "both"]);

        $this->repeat = $repeat;
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
     * Get the URL
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the URL
     * @param string $URL
     * @return $this
     */
    public function setURL($URL)
    {
        Assert::uri($URL);

        $this->URL = $URL;
        return $this;
    }

    /**
     * Get the verticalAlignment
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->verticalAlignment;
    }

    /**
     * Set the verticalAlignment
     * @param string $verticalAlignment
     * @return $this
     */
    public function setVerticalAlignment($verticalAlignment)
    {
        if (is_null($verticalAlignment)) {
            $this->verticalAlignment = null;
            return $this;
        }

        Assert::oneOf($verticalAlignment, ["top", "center", "bottom"]);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Get the width
     * @return integer|string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set the width
     * @param integer|string $width
     * @return $this
     */
    public function setWidth($width)
    {
        if (is_null($width)) {
            $this->width = null;
            return $this;
        }

        Assert::isSupportedUnits($width);

        $this->width = $width;
        return $this;
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
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->attachment)) {
            $data['attachment'] = $this->attachment;
        }
        if (isset($this->height)) {
            $data['height'] =
                $this->height instanceof Arrayable
                    ? $this->height->toArray()
                    : $this->height;
        }
        if (isset($this->horizontalAlignment)) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }
        if (isset($this->repeat)) {
            $data['repeat'] = $this->repeat;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        if (isset($this->width)) {
            $data['width'] =
                $this->width instanceof Arrayable
                    ? $this->width->toArray()
                    : $this->width;
        }
        return $data;
    }
}
