<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for adding an image background fill to a component.
 *
 * @see https://developer.apple.com/documentation/apple_news/imagefill
 */
class ImageFill extends Fill
{
    /**
     * The URL of the image file to use for filling the component.
     * @var string
     */
    protected $URL;

    /**
     * Indicates how the image fill should be displayed. Valid values:
     * @var string
     */
    protected $fillMode;

    /**
     * Sets the horizontal alignment of the image fill within its component.
     * Valid values:
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
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
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
     * Get the fillMode
     * @return string
     */
    public function getFillMode()
    {
        return $this->fillMode;
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
     * Get the verticalAlignment
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->verticalAlignment;
    }

    /**
     * Set the fillMode
     * @param string $fillMode
     * @return $this
     */
    public function setFillMode($fillMode)
    {
        Assert::oneOf($fillMode, ["fit", "cover"]);

        $this->fillMode = $fillMode;
        return $this;
    }

    /**
     * Set the horizontalAlignment
     * @param string $horizontalAlignment
     * @return $this
     */
    public function setHorizontalAlignment($horizontalAlignment)
    {
        Assert::oneOf($horizontalAlignment, ["left", "center", "right"]);

        $this->horizontalAlignment = $horizontalAlignment;
        return $this;
    }

    /**
     * Set the URL
     * @param string $URL
     * @return $this
     */
    public function setURL($URL)
    {
        Assert::string($URL);

        $this->URL = $URL;
        return $this;
    }

    /**
     * Set the verticalAlignment
     * @param string $verticalAlignment
     * @return $this
     */
    public function setVerticalAlignment($verticalAlignment)
    {
        Assert::oneOf($verticalAlignment, ["top", "center", "bottom"]);

        $this->verticalAlignment = $verticalAlignment;
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
        $data = parent::toArray();
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
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
