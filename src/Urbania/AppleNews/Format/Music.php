<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding a playable music file.
 *
 * @see https://developer.apple.com/documentation/apple_news/music
 */
class Music extends Component
{
    /**
     * The URL of an audio file (HTTP or HTTPS only). This component supports
     * all AVPlayer audio formats, including the following:
     * @var uri
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
     * This component always has a role of music.
     * @var string
     */
    protected $role = 'music';

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
     * Get the caption
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
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
     * Get the imageURL
     * @return string
     */
    public function getImageURL()
    {
        return $this->imageURL;
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
     * @return uri
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the accessibilityCaption
     * @param string $accessibilityCaption
     * @return $this
     */
    public function setAccessibilityCaption($accessibilityCaption)
    {
        Assert::string($accessibilityCaption);

        $this->accessibilityCaption = $accessibilityCaption;
        return $this;
    }

    /**
     * Set the caption
     * @param string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        Assert::string($caption);

        $this->caption = $caption;
        return $this;
    }

    /**
     * Set the explicitContent
     * @param boolean $explicitContent
     * @return $this
     */
    public function setExplicitContent($explicitContent)
    {
        Assert::boolean($explicitContent);

        $this->explicitContent = $explicitContent;
        return $this;
    }

    /**
     * Set the imageURL
     * @param string $imageURL
     * @return $this
     */
    public function setImageURL($imageURL)
    {
        Assert::string($imageURL);

        $this->imageURL = $imageURL;
        return $this;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'URL' => $this->URL,
            'accessibilityCaption' => $this->accessibilityCaption,
            'caption' => $this->caption,
            'explicitContent' => $this->explicitContent,
            'imageURL' => $this->imageURL,
            'role' => $this->role
        ]);
    }
}
