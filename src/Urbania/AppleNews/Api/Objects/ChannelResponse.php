<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See which objects make up the channel response.
 *
 * @see https://developer.apple.com/documentation/apple_news/channelresponse
 */
class ChannelResponse extends Channel
{
    /** @var \Urbania\AppleNews\Api\Objects\ChannelLinks */
    protected $links;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }
    }

    /**
     * Get the links
     * @return \Urbania\AppleNews\Api\Objects\ChannelLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\ChannelLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        if (is_object($links)) {
            Assert::isInstanceOf($links, ChannelLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links) ? new ChannelLinks($links) : $links;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->links)) {
            $data['links'] = is_object($this->links)
                ? $this->links->toArray()
                : $this->links;
        }
        return $data;
    }
}
