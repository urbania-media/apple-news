<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * An object used in a gallery or mosaic component for displaying an
 * individual image.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/galleryitem.json
 */
class GalleryItem extends BaseSdkObject
{
    /**
     * The URL of an image to display in a gallery or mosaic.
     * Image URLs can begin with http://, https://, or bundle://. If the
     * image URL begins with bundle://, the image file must be in the same
     * directory as the document.
     * Image filenames should be properly encoded as URLs.
     * See .
     * @var string
     */
    protected $URL;

    /**
     * A caption that describes the image. The text is used for VoiceOver.
     * For more information about VoiceOver, see the  page in Accessibility.
     * If accessibilityCaption is not provided, the caption value is used for
     * VoiceOver for iOS, VoiceOver for iPadOS, and VoiceOver for macOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * A caption that describes the image. The article displays this text
     * when the image is full screen, and VoiceOver uses this text if you
     * don’t provide accessibilityCaption text. For more information about
     * VoiceOver, see the  page in Accessibility. The caption text doesn’t
     * appear in the main article view. To display a caption in the main
     * article view, use the  component.
     * @var \Urbania\AppleNews\Format\CaptionDescriptor|string
     */
    protected $caption;

    /**
     * A Boolean value that indicates the image may contain explicit content.
     * @var boolean
     */
    protected $explicitContent;

    public function __construct(array $data = [])
    {
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
     * @return \Urbania\AppleNews\Format\CaptionDescriptor|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption
     * @param \Urbania\AppleNews\Format\CaptionDescriptor|array|string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        if (is_null($caption)) {
            $this->caption = null;
            return $this;
        }

        if (is_object($caption) || Utils::isAssociativeArray($caption)) {
            Assert::isSdkObject($caption, CaptionDescriptor::class);
        } else {
            Assert::string($caption);
        }

        $this->caption = Utils::isAssociativeArray($caption)
            ? new CaptionDescriptor($caption)
            : $caption;
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
        $data = [];
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->accessibilityCaption)) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
        }
        if (isset($this->caption)) {
            $data['caption'] =
                $this->caption instanceof Arrayable ? $this->caption->toArray() : $this->caption;
        }
        if (isset($this->explicitContent)) {
            $data['explicitContent'] = $this->explicitContent;
        }
        return $data;
    }
}
