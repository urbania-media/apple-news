<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See which objects make up the section response.
 *
 * @see https://developer.apple.com/documentation/apple_news/sectionresponse
 */
class SectionResponse extends Section
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
