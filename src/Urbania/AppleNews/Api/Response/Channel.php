<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

class Channel extends Response
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $type = 'Channel';

    /** @var string */
    protected $name;

    /** @var string */
    protected $shareUrl;

    /** @var string */
    protected $website;

    /** @var \Carbon\Carbon */
    protected $modifiedAt;

    /** @var \Carbon\Carbon */
    protected $createdAt;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->setId($data['id']);
        }

        if (isset($data['name'])) {
            $this->setName($data['name']);
        }

        if (isset($data['shareUrl'])) {
            $this->setShareUrl($data['shareUrl']);
        }

        if (isset($data['website'])) {
            $this->setWebsite($data['website']);
        }

        if (isset($data['modifiedAt'])) {
            $this->setModifiedAt($data['modifiedAt']);
        }

        if (isset($data['createdAt'])) {
            $this->setCreatedAt($data['createdAt']);
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
     * Get the website
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set the createdAt
     * @param \Carbon\Carbon|string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if (is_object($createdAt)) {
            Assert::isInstanceOf($createdAt, Carbon::class);
        } else {
            Assert::string($createdAt);
            Assert::regex(
                $createdAt,
                '/^(-?(?:[1-9][0-9]*)?[0-9]{4})-(1[0-2]|0[1-9])-(3[01]|0[1-9]|[12][0-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])(\.[0-9]+)?(Z)?$/'
            );
        }

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
        Assert::string($id);

        $this->id = $id;
        return $this;
    }

    /**
     * Set the modifiedAt
     * @param \Carbon\Carbon|string $modifiedAt
     * @return $this
     */
    public function setModifiedAt($modifiedAt)
    {
        if (is_object($modifiedAt)) {
            Assert::isInstanceOf($modifiedAt, Carbon::class);
        } else {
            Assert::string($modifiedAt);
            Assert::regex(
                $modifiedAt,
                '/^(-?(?:[1-9][0-9]*)?[0-9]{4})-(1[0-2]|0[1-9])-(3[01]|0[1-9]|[12][0-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])(\.[0-9]+)?(Z)?$/'
            );
        }

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
     * Set the website
     * @param string $website
     * @return $this
     */
    public function setWebsite($website)
    {
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
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'shareUrl' => $this->shareUrl,
            'website' => $this->website,
            'modifiedAt' => !is_null($this->modifiedAt)
                ? $this->modifiedAt->toIso8601String()
                : null,
            'createdAt' => !is_null($this->createdAt)
                ? $this->createdAt->toIso8601String()
                : null
        ];
    }
}
