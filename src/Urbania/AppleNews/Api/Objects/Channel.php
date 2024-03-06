<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the fields the read channel endpoint returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/channel.json
 */
class Channel extends BaseSdkObject
{
    /**
     * The date and time the channel was created.
     * @var \Carbon\Carbon
     */
    protected $createdAt;

    /**
     * The list of custom fonts used in the channel. This list may be empty.
     * @var string[]
     */
    protected $fonts;

    /**
     * The unique identifier of the channel.
     * @var string
     */
    protected $id;

    /**
     * The date and time the channel was last modified.
     * @var \Carbon\Carbon
     */
    protected $modifiedAt;

    /**
     * The name of the channel.
     * @var string
     */
    protected $name;

    /**
     * The URL to the channel within the News app.
     * @var string
     */
    protected $shareUrl;

    /**
     * The channel.
     * @var string
     */
    protected $type;

    /**
     * The website that corresponds to this channel.
     * @var string
     */
    protected $website;

    public function __construct(array $data = [])
    {
        if (isset($data['createdAt'])) {
            $this->setCreatedAt($data['createdAt']);
        }

        if (isset($data['fonts'])) {
            $this->setFonts($data['fonts']);
        }

        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['modifiedAt'])) {
            $this->setModifiedAt($data['modifiedAt']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['shareUrl'])) {
            $this->setShareUrl($data['shareUrl']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['website'])) {
            $this->setWebsite($data['website']);
        }
    }

    /**
     * Get the createdAt
     * @return \Carbon\Carbon
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the createdAt
     * @param \Carbon\Carbon|string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if (is_null($createdAt)) {
            $this->createdAt = null;
            return $this;
        }

        Assert::isDate($createdAt);

        $this->createdAt = is_string($createdAt) ? Carbon::parse($createdAt) : $createdAt;
        return $this;
    }

    /**
     * Add an item to fonts
     * @param string $item
     * @return $this
     */
    public function addFont($item)
    {
        return $this->setFonts(
            !is_null($this->fonts) ? array_merge($this->fonts, [$item]) : [$item]
        );
    }

    /**
     * Add items to fonts
     * @param array $items
     * @return $this
     */
    public function addFonts($items)
    {
        Assert::isArray($items);
        return $this->setFonts(!is_null($this->fonts) ? array_merge($this->fonts, $items) : $items);
    }

    /**
     * Get the fonts
     * @return string[]
     */
    public function getFonts()
    {
        return $this->fonts;
    }

    /**
     * Set the fonts
     * @param string[] $fonts
     * @return $this
     */
    public function setFonts($fonts)
    {
        if (is_null($fonts)) {
            $this->fonts = null;
            return $this;
        }

        Assert::isArray($fonts);
        Assert::allString($fonts);

        $this->fonts = $fonts;
        return $this;
    }

    /**
     * Get the id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the id
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        if (is_null($id)) {
            $this->id = null;
            return $this;
        }

        Assert::uuid($id);

        $this->id = $id;
        return $this;
    }

    /**
     * Get the modifiedAt
     * @return \Carbon\Carbon
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * Set the modifiedAt
     * @param \Carbon\Carbon|string $modifiedAt
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        if (is_null($modifiedAt)) {
            $this->modifiedAt = null;
            return $this;
        }

        Assert::isDate($modifiedAt);

        $this->modifiedAt = is_string($modifiedAt) ? Carbon::parse($modifiedAt) : $modifiedAt;
        return $this;
    }

    /**
     * Get the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        if (is_null($name)) {
            $this->name = null;
            return $this;
        }

        Assert::string($name);

        $this->name = $name;
        return $this;
    }

    /**
     * Get the shareUrl
     * @return string
     */
    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    /**
     * Set the shareUrl
     * @param string $shareUrl
     * @return $this
     */
    public function setShareUrl($shareUrl)
    {
        if (is_null($shareUrl)) {
            $this->shareUrl = null;
            return $this;
        }

        Assert::string($shareUrl);

        $this->shareUrl = $shareUrl;
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
        if (is_null($type)) {
            $this->type = null;
            return $this;
        }

        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Get the website
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the website
     * @param string $website
     * @return $this
     */
    public function setWebsite($website)
    {
        if (is_null($website)) {
            $this->website = null;
            return $this;
        }

        Assert::string($website);

        $this->website = $website;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->createdAt)) {
            $data['createdAt'] = !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null;
        }
        if (isset($this->fonts)) {
            $data['fonts'] = $this->fonts;
        }
        if (isset($this->id)) {
            $data['id'] = $this->id;
        }
        if (isset($this->modifiedAt)) {
            $data['modifiedAt'] = !is_null($this->modifiedAt)
                ? $this->modifiedAt->toIso8601String()
                : null;
        }
        if (isset($this->name)) {
            $data['name'] = $this->name;
        }
        if (isset($this->shareUrl)) {
            $data['shareUrl'] = $this->shareUrl;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->website)) {
            $data['website'] = $this->website;
        }
        return $data;
    }
}
