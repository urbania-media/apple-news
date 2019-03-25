<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for adding a video background fill to a component.
 *
 * @see https://developer.apple.com/documentation/apple_news/videofill
 */
class VideoFill extends Fill
{
    /**
     * The URL of the image file to use as a still image when the video is
     * not playing.
     * @var string
     */
    protected $stillURL;

    /**
     * Always video for this object.
     * @var string
     */
    protected $type = 'video';

    /**
     * The URL of a video file that can be played using AV Player. HTTP Live
     * Streaming (HLS) is highly recommended (.M3U8). For more information on
     * HLS, refer to the iOS developer documentation on HTTP Live Streaming,
     * especially the following sections of the HTTP Live Streaming Overview:
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
     * A string that indicates how the video fill should be displayed.
     * @var string
     */
    protected $fillMode;

    /**
     * A string that sets the horizontal alignment of the video fill within
     * its component.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * A Boolean value when set to true, specifies that the video will start
     * over again when it reaches the end.
     * @var boolean
     */
    protected $loop;

    /**
     * A string value that sets the vertical alignment of the video fill
     * within its component.
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['stillURL'])) {
            $this->setStillURL($data['stillURL']);
        }

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

        if (isset($data['loop'])) {
            $this->setLoop($data['loop']);
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

        Assert::oneOf($attachment, ["fixed", "scroll"]);

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
        if (is_null($horizontalAlignment)) {
            $this->horizontalAlignment = null;
            return $this;
        }

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
        if (is_null($loop)) {
            $this->loop = null;
            return $this;
        }

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
        Assert::uri($stillURL);

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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->stillURL)) {
            $data['stillURL'] = $this->stillURL;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
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
        if (isset($this->loop)) {
            $data['loop'] = $this->loop;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        return $data;
    }
}
