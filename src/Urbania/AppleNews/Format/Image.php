<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for displaying JPEG, PNG, or GIF images.
 *
 * @see https://developer.apple.com/documentation/apple_news/image
 */
class Image extends Component
{
    /**
     * The URL of an image file.
     * @var string
     */
    protected $URL;

    /**
     * A caption that describes the image. Note that this property differs
     * from caption: although the caption can be displayed to users, the
     * accessibilityCaption is used by VoiceOver for iOS only. If
     * accessibilityCaption is not provided the caption value is used for
     * VoiceOver for iOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * An array of ComponentLink objects. This can be used to create a
     * ComponentLink, allowing a link to anywhere in News.
     * @var Format\ComponentLink[]
     */
    protected $additions;

    /**
     * A caption that describes the image. This text can be used by VoiceOver
     * for iOS (compare accessibilityCaption). It will not appear in the main
     * article view. To display a caption in the main article view, use a
     * Caption component.
     * @var string
     */
    protected $caption;

    /**
     * Indicates that the image may contain explicit content.
     * @var boolean
     */
    protected $explicitContent;

    /**
     * Only image is supported.
     * @var string
     */
    protected $role;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
        }

        if (isset($data['additions'])) {
            $this->setAdditions($data['additions']);
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
     * Get the additions
     * @return Format\ComponentLink[]
     */
    public function getAdditions()
    {
        return $this->additions;
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
     * Set the additions
     * @param Format\ComponentLink[] $additions
     * @return $this
     */
    public function setAdditions($additions)
    {
        Assert::isArray($additions);
        Assert::allIsInstanceOfOrArray($additions, ComponentLink::class);

        $items = [];
        foreach ($additions as $key => $item) {
            $items[$key] = is_array($item) ? new ComponentLink($item) : $item;
        }
        $this->additions = $items;
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
        if (isset($this->accessibilityCaption)) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
        }
        if (isset($this->additions)) {
            $data['additions'] = !is_null($this->additions)
                ? array_reduce(
                    array_keys($this->additions),
                    function ($items, $key) {
                        $items[$key] = is_object($this->additions[$key])
                            ? $this->additions[$key]->toArray()
                            : $this->additions[$key];
                        return $items;
                    },
                    []
                )
                : $this->additions;
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
        return $data;
    }
}
