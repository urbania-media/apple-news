<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the fields returned by the section endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/section
 */
class Section
{
    /**
     * The date and time this section was created.
     * @var \Carbon\Carbon
     */
    protected $createdAt;

    /**
     * The unique identifier of the specified section.
     * @var string
     */
    protected $id;

    /**
     * A Boolean value that indicates whether this is the default section for
     * the channel.
     * @var boolean
     */
    protected $isDefault;

    /**
     * The date and time this section was last modified.
     * @var \Carbon\Carbon
     */
    protected $modifiedAt;

    /**
     * The name of the section.
     * @var string
     */
    protected $name;

    /**
     * The URL of the channel in which this section appears.
     * @var string
     */
    protected $shareUrl;

    /**
     * Section
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['createdAt'])) {
            $this->setCreatedAt($data['createdAt']);
        }

        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['isDefault'])) {
            $this->setIsDefault($data['isDefault']);
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
     * Get the id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the isDefault
     * @return boolean
     */
    public function getIsDefault()
    {
        return $this->isDefault;
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
     * Get the name
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the createdAt
     * @param \Carbon\Carbon|string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        Assert::isDate($createdAt);

        $this->createdAt = is_string($createdAt)
            ? Carbon::parse($createdAt)
            : $createdAt;
        return $this;
    }

    /**
     * Set the id
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        Assert::uuid($id);

        $this->id = $id;
        return $this;
    }

    /**
     * Set the isDefault
     * @param boolean $isDefault
     * @return $this
     */
    public function setIsDefault($isDefault)
    {
        Assert::boolean($isDefault);

        $this->isDefault = $isDefault;
        return $this;
    }

    /**
     * Set the modifiedAt
     * @param \Carbon\Carbon|string $modifiedAt
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        Assert::isDate($modifiedAt);

        $this->modifiedAt = is_string($modifiedAt)
            ? Carbon::parse($modifiedAt)
            : $modifiedAt;
        return $this;
    }

    /**
     * Set the name
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        Assert::string($name);

        $this->name = $name;
        return $this;
    }

    /**
     * Set the shareUrl
     * @param string $shareUrl
     * @return $this
     */
    public function setShareUrl($shareUrl)
    {
        Assert::string($shareUrl);

        $this->shareUrl = $shareUrl;
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
        $data = [];
        if (isset($this->createdAt)) {
            $data['createdAt'] = !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null;
        }
        if (isset($this->id)) {
            $data['id'] = $this->id;
        }
        if (isset($this->isDefault)) {
            $data['isDefault'] = $this->isDefault;
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
        return $data;
    }
}
