<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See which objects make up the section response.
 *
 * @see https://developer.apple.com/documentation/apple_news/sectionresponse
 */
class SectionResponse extends Section
{
    /** @var \Urbania\AppleNews\Api\Objects\SectionLinks */
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
     * @return \Urbania\AppleNews\Api\Objects\SectionLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\SectionLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        Assert::isSdkObject($links, SectionLinks::class);

        $this->links = is_array($links) ? new SectionLinks($links) : $links;
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
            $data['links'] =
                $this->links instanceof Arrayable
                    ? $this->links->toArray()
                    : $this->links;
        }
        return $data;
    }
}
