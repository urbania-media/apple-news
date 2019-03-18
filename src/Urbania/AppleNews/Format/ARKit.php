<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding an augmented reality (AR) experience to your
 * article.
 *
 * @see https://developer.apple.com/documentation/apple_news/arkit
 */
class ARKit extends Component
{
    /**
     * Valid URL to a Universal Scene Description file (USD) file with
     * extension .usdz, beginning with http://, https:// or bundle://.
     * @var string
     */
    protected $URL;

    /**
     * Optional caption text describing the contents of the component. Note
     * that this property differs from caption: although the caption may be
     * displayed to users, the accessiblityCaption is used for voice-over
     * only. The value in this property should describe the contents of the
     * image for non-sighted users. If this property is omitted, the value
     * from caption is used for voice-over.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * A string that describes the contents of the ARKit stage.
     * @var string
     */
    protected $caption;

    /**
     * This property indicates that the component may contain explicit or
     * graphic content.
     * @var boolean
     */
    protected $explicitContent;

    /**
     * This component always has a role of  arkit.
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
            'role' => $this->role
        ]);
    }
}
