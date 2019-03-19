<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the links returned by the section endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/sectionlinks
 */
class SectionLinks extends BaseSdkObject
{
    /**
     * The URL of the channel in which this section appears.
     * @var string
     */
    protected $channel;

    /**
     * The URL at which this resource can be read.
     * @var string
     */
    protected $self;

    public function __construct(array $data = [])
    {
        if (isset($data['channel'])) {
            $this->setChannel($data['channel']);
        }

        if (isset($data['self'])) {
            $this->setSelf($data['self']);
        }
    }

    /**
     * Get the channel
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set the channel
     * @param string $channel
     * @return $this
     */
    public function setChannel($channel)
    {
        if (is_null($channel)) {
            $this->channel = null;
            return $this;
        }

        Assert::string($channel);

        $this->channel = $channel;
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
        if (is_null($self)) {
            $this->self = null;
            return $this;
        }

        Assert::string($self);

        $this->self = $self;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->channel)) {
            $data['channel'] = $this->channel;
        }
        if (isset($this->self)) {
            $data['self'] = $this->self;
        }
        return $data;
    }
}
