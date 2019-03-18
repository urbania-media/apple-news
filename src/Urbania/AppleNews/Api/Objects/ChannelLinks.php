<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the links returned by the read channel endpoint.
 *
 * @see https://developer.apple.com/documentation/apple_news/channellinks
 */
class ChannelLinks implements \JsonSerializable
{
    /**
     * The URL for this channel’s default section. Every channel has a
     * default section, even if no others are defined.
     * @var string
     */
    protected $defaultSection;

    /**
     * The URL at which this resource can be read.
     * @var string
     */
    protected $self;

    public function __construct(array $data = [])
    {
        if (isset($data['defaultSection'])) {
            $this->setDefaultSection($data['defaultSection']);
        }

        if (isset($data['self'])) {
            $this->setSelf($data['self']);
        }
    }

    /**
     * Get the defaultSection
     * @return string
     */
    public function getDefaultSection()
    {
        return $this->defaultSection;
    }

    /**
     * Set the defaultSection
     * @param string $defaultSection
     * @return $this
     */
    public function setDefaultSection($defaultSection)
    {
        Assert::string($defaultSection);

        $this->defaultSection = $defaultSection;
        return $this;
    }

    /**
     * Get the self
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Set the self
     * @param string $self
     * @return $this
     */
    public function setSelf($self)
    {
        Assert::string($self);

        $this->self = $self;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        if (isset($this->defaultSection)) {
            $data['defaultSection'] = $this->defaultSection;
        }
        if (isset($this->self)) {
            $data['self'] = $this->self;
        }
        return $data;
    }
}
