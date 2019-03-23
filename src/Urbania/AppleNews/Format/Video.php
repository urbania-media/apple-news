<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for adding a video.
 *
 * @see https://developer.apple.com/documentation/apple_news/video
 */
class Video extends Component
{
    /**
     * The URL of a video file that can be played using AVPlayer. HTTP Live
     * Streaming (HLS) is highly recommended (.M3U8). For more information on
     * HLS, refer to the iOS developer documentation on HTTP Live Streaming,
     * especially the following sections of the HTTP Live Streaming Overview:
     * @var string
     */
    protected $URL;

    /**
     * A caption that describes the content of the video. Note that this
     * property differs from caption: although the caption can be displayed
     * to users, the accessibilityCaption is used by VoiceOver for iOS only.
     * If accessibilityCaption is omitted, the caption value is used for
     * VoiceOver for iOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * The aspect ratio of the video: width divided by height. The aspect
     * ratio determines the height of the video player.
     * @var integer|float
     */
    protected $aspectRatio;

    /**
     * A caption that describes the content of the video file. This text can
     * be used by VoiceOver for iOS if accessibilityCaption is not provided,
     * or it can be shown when the video cannot be played.
     * @var string
     */
    protected $caption;

    /**
     * Indicates that the video or its still image may contain explicit
     * content.
     * @var boolean
     */
    protected $explicitContent;

    /**
     * This component always a the role of video.
     * @var string
     */
    protected $role;

    /**
     * The URL of an image file that should be shown when the video has not
     * yet been played.
     * @var string
     */
    protected $stillURL;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
        }

        if (isset($data['aspectRatio'])) {
            $this->setAspectRatio($data['aspectRatio']);
        }

        if (isset($data['caption'])) {
            $this->setCaption($data['caption']);
        }

        if (isset($data['explicitContent'])) {
            $this->setExplicitContent($data['explicitContent']);
        }

        if (isset($data['role'])) {
            $this->setRole($data['role']);
        }

        if (isset($data['stillURL'])) {
            $this->setStillURL($data['stillURL']);
        }
    }

    /**
     * Get the accessibilityCaption
     * @return string
     */
    public function getAccessibilityCaption()
    {
        return $this->accessibilityCaption;
    }

    /**
     * Set the accessibilityCaption
     * @param string $accessibilityCaption
     * @return $this
     */
    public function setAccessibilityCaption($accessibilityCaption)
    {
        if (is_null($accessibilityCaption)) {
            $this->accessibilityCaption = null;
            return $this;
        }

        Assert::string($accessibilityCaption);

        $this->accessibilityCaption = $accessibilityCaption;
        return $this;
    }

    /**
     * Get the aspectRatio
     * @return integer|float
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * Set the aspectRatio
     * @param integer|float $aspectRatio
     * @return $this
     */
    public function setAspectRatio($aspectRatio)
    {
        if (is_null($aspectRatio)) {
            $this->aspectRatio = null;
            return $this;
        }

        Assert::number($aspectRatio);

        $this->aspectRatio = $aspectRatio;
        return $this;
    }

    /**
     * Get the caption
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption
     * @param string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        if (is_null($caption)) {
            $this->caption = null;
            return $this;
        }

        Assert::string($caption);

        $this->caption = $caption;
        return $this;
    }

    /**
     * Get the explicitContent
     * @return boolean
     */
    public function getExplicitContent()
    {
        return $this->explicitContent;
    }

    /**
     * Set the explicitContent
     * @param boolean $explicitContent
     * @return $this
     */
    public function setExplicitContent($explicitContent)
    {
        if (is_null($explicitContent)) {
            $this->explicitContent = null;
            return $this;
        }

        Assert::boolean($explicitContent);

        $this->explicitContent = $explicitContent;
        return $this;
    }

    /**
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        Assert::string($role);

        $this->role = $role;
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
        if (is_null($stillURL)) {
            $this->stillURL = null;
            return $this;
        }

        Assert::string($stillURL);

        $this->stillURL = $stillURL;
        return $this;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->accessibilityCaption)) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
        }
        if (isset($this->aspectRatio)) {
            $data['aspectRatio'] = $this->aspectRatio;
        }
        if (isset($this->caption)) {
            $data['caption'] = $this->caption;
        }
        if (isset($this->explicitContent)) {
            $data['explicitContent'] = $this->explicitContent;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->stillURL)) {
            $data['stillURL'] = $this->stillURL;
        }
        return $data;
    }
}
