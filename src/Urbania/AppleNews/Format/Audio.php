<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for adding a playable audio clip.
 *
 * @see https://developer.apple.com/documentation/apple_news/audio
 */
class Audio extends Component
{
    /**
     * The URL of an audio file (http or https only). This component supports
     * all AVPlayer audio formats, including the following:
     * @var string
     */
    protected $URL;

    /**
     * A caption that describes the content of the audio file. Note that this
     * property differs from caption: although the caption can be displayed
     * to users, the accessibilityCaption is used by VoiceOver for iOS only.
     * If accessibilityCaption is omitted, the caption value is used for
     * VoiceOver for iOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * A caption that describes the content of the audio file. This text can
     * be used by VoiceOver for iOS if accessibilityCaption is not provided,
     * or it can be shown when the audio cannot be played.
     * @var string
     */
    protected $caption;

    /**
     * Indicates that the audio may contain explicit content.
     * @var boolean
     */
    protected $explicitContent;

    /**
     * The URL of an image file that represents the audio file, such as a
     * cover image.
     * @var string
     */
    protected $imageURL;

    /**
     * This component always has a role of audio.
     * @var string
     */
    protected $role = 'audio';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
        }

        if (isset($data['caption'])) {
            $this->setCaption($data['caption']);
        }

        if (isset($data['explicitContent'])) {
            $this->setExplicitContent($data['explicitContent']);
        }

        if (isset($data['imageURL'])) {
            $this->setImageURL($data['imageURL']);
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
     * Get the imageURL
     * @return string
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * Set the imageURL
     * @param string $imageURL
     * @return $this
     */
    public function setImageURL($imageURL)
    {
        if (is_null($imageURL)) {
            $this->imageURL = null;
            return $this;
        }

        Assert::string($imageURL);

        $this->imageURL = $imageURL;
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
        if (isset($this->caption)) {
            $data['caption'] = $this->caption;
        }
        if (isset($this->explicitContent)) {
            $data['explicitContent'] = $this->explicitContent;
        }
        if (isset($this->imageURL)) {
            $data['imageURL'] = $this->imageURL;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        return $data;
    }
}
