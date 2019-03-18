<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

class ChannelResponse extends Channel
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'links' => is_object($this->links)
                ? $this->links->toArray()
                : $this->links
        ]);
    }
}
