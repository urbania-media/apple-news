<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See which objects make up the section response.
 *
 * @see https://developer.apple.com/documentation/apple_news/sectionresponse
 */
class SectionResponse extends Section implements \JsonSerializable
{
    /** @var \Urbania\AppleNews\Api\Response\SectionLinks */
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
     * @return \Urbania\AppleNews\Api\Response\SectionLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Response\SectionLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_object($links)) {
            Assert::isInstanceOf($links, SectionLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links) ? new SectionLinks($links) : $links;
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
