<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for specifying cover art that is required for an article to
 * be considered for inclusion in the Featured Stories section.
 *
 * @see https://developer.apple.com/documentation/apple_news/coverart
 */
class CoverArt
{
    /**
     * The URL of the image file.
     * @var string
     */
    protected $URL;

    /**
     * A caption that describes the content of the cover image. The
     * accessibilityCaption is used by VoiceOver for iOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * The type of cover art provided. Currently, image is supported.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'URL' => $this->URL,
            'accessibilityCaption' => $this->accessibilityCaption,
            'type' => $this->type
        ];
    }
}
