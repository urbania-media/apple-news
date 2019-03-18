<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for adding a video background fill to a component.
 *
 * @see https://developer.apple.com/documentation/apple_news/videofill
 */
class VideoFill extends Fill implements \JsonSerializable
{
    /**
     * The URL of a video file that can be played using AV Player. HTTP Live
     * Streaming (HLS) is highly recommended (.M3U8). For more information on
     * HLS, refer to the iOS developer documentation on HTTP Live Streaming,
     * especially the following sections of the HTTP Live Streaming Overview:
     * @var uri
     */
    protected $URL;

    /**
     * Indicates how the video fill should be displayed. Valid values:
     * @var string
     */
    protected $fillMode;

    /**
     * Sets the horizontal alignment of the video fill within its component.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * When true, it specifies that the video will start over again when it
     * reaches the end.
     * @var boolean
     */
    protected $loop;

    /**
     * The URL of the image file to use as a still image when the video is
     * not playing.
     * @var string
     */
    protected $stillURL;

    /**
     * Describes the type of fill. Must be video for a video fill.
     * @var string
     */
    protected $type;

    /**
     * Sets the vertical alignment of the video fill within its component.
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

        if (isset($data['loop'])) {
            $this->setLoop($data['loop']);
        }

        if (isset($data['stillURL'])) {
            $this->setStillURL($data['stillURL']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
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
        Assert::oneOf($horizontalAlignment, ["left", "center", "right"]);

        $this->horizontalAlignment = $horizontalAlignment;
        return $this;
    }

    /**
     * Get the loop
     * @return boolean
     */
    public function getLoop()
    {
        return $this->loop;
    }

    /**
     * Set the loop
     * @param boolean $loop
     * @return $this
     */
    public function setLoop($loop)
    {
        Assert::boolean($loop);

        $this->loop = $loop;
        return $this;
    }

    /**
     * Get the stillURL
     * @return string
     */
    public function getStillURL()
    {
        return $this->stillURL;
    }

    /**
     * Set the stillURL
     * @param string $stillURL
     * @return $this
     */
    public function setStillURL($stillURL)
    {
        Assert::string($stillURL);

        $this->stillURL = $stillURL;
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Get the URL
     * @return uri
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the URL
     * @param uri $URL
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
        Assert::oneOf($verticalAlignment, ["top", "center", "bottom"]);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        if (isset($this->loop)) {
            $data['loop'] = $this->loop;
        }
        if (isset($this->stillURL)) {
            $data['stillURL'] = $this->stillURL;
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
