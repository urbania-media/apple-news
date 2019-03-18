<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See which objects make up the channel response.
 *
 * @see https://developer.apple.com/documentation/apple_news/channelresponse
 */
class ChannelResponse extends Channel implements \JsonSerializable
{
    /** @var \Urbania\AppleNews\Api\Response\ChannelLinks */
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
     * @return \Urbania\AppleNews\Api\Response\ChannelLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Response\ChannelLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_object($links)) {
            Assert::isInstanceOf($links, ChannelLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links) ? new ChannelLinks($links) : $links;
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
        $data = parent::toArray();
        if (isset($this->links)) {
            $data['links'] = is_object($this->links)
                ? $this->links->toArray()
                : $this->links;
        }
        return $data;
    }
}
