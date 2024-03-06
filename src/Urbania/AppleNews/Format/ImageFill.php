<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for adding an image background fill to a component.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/imagefill.json
 */
class ImageFill extends Fill
{
    /**
     * The URL of the image file to use for filling the component.
     * Image URLs can begin with http://, https://, or bundle://. If the
     * image URL begins with bundle://, the referenced image file must be in
     * the same directory as the document.
     * Image filenames should be properly encoded as URLs
     * See .
     * @var string
     */
    protected $URL;

    /**
     * A string that indicates how the fill should behave when a user
     * scrolls.
     * Valid values:
     * @var string
     */
    protected $attachment;

    /**
     * Indicates how the image fill should be displayed.
     * Valid values:
     * @var string
     */
    protected $fillMode;

    /**
     * Sets the horizontal alignment of the image fill within its component.
     * Valid values:
     * You can use fillMode with horizontalAlignment to achieve the effect
     * you want. For example, set fillMode to fit and horizontalAlignment to
     * left to fit the image based on its aspect ratio and also align the
     * left edge of the fill with the left edge of the component. Or set
     * fillMode to cover and horizontalAlignment to right to scale the image
     * horizontally and also align the right edge of the fill with the right
     * edge of the component.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * The type of fill to apply. This property should always be set to
     * image.
     * @var string
     */
    protected $type = 'image';

    /**
     * Sets the vertical alignment of the image fill within its component.
     * Valid values:
     * You can use fillMode with verticalAlignment to achieve the effect you
     * want. For example, set fillMode to fit and verticalAlignment to top to
     * fit the image based on its aspect ratio and also align the top of the
     * fill with the top edge of the component. Or set fillMode to cover and
     * verticalAlignment to top to scale the image vertically and also align
     * the top of the fill with the top edge of the component.
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['attachment'])) {
            $this->setAttachment($data['attachment']);
        }

        if (isset($data['fillMode'])) {
            $this->setFillMode($data['fillMode']);
        }

        if (isset($data['horizontalAlignment'])) {
            $this->setHorizontalAlignment($data['horizontalAlignment']);
        }

        if (isset($data['verticalAlignment'])) {
            $this->setVerticalAlignment($data['verticalAlignment']);
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

        Assert::oneOf($attachment, ['fixed', 'scroll']);

        $this->attachment = $attachment;
        return $this;
    }

    /**
     * Get the fillMode
     * @return string
     */
    public function getFillMode()
    {
        return $this->fillMode;
    }

    /**
     * Set the fillMode
     * @param string $fillMode
     * @return $this
     */
    public function setFillMode($fillMode)
    {
        if (is_null($fillMode)) {
            $this->fillMode = null;
            return $this;
        }

        Assert::oneOf($fillMode, ['fit', 'cover']);

        $this->fillMode = $fillMode;
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

        Assert::oneOf($horizontalAlignment, ['left', 'center', 'right']);

        $this->horizontalAlignment = $horizontalAlignment;
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

        Assert::oneOf($verticalAlignment, ['top', 'center', 'bottom']);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->attachment)) {
            $data['attachment'] = $this->attachment;
        }
        if (isset($this->fillMode)) {
            $data['fillMode'] = $this->fillMode;
        }
        if (isset($this->horizontalAlignment)) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        return $data;
    }
}
