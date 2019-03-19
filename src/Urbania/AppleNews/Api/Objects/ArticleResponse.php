<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See which objects make up the publish article, read article, and
 * update article responses.
 *
 * @see https://developer.apple.com/documentation/apple_news/articleresponse
 */
class ArticleResponse extends Article
{
    /** @var \Urbania\AppleNews\Api\Objects\ArticleLinks */
    protected $links;

    /** @var \Urbania\AppleNews\Api\Objects\Meta */
    protected $meta;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }

        if (isset($data['meta'])) {
            $this->setMeta($data['meta']);
        }
    }

    /**
     * Get the links
     * @return \Urbania\AppleNews\Api\Objects\ArticleLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\ArticleLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        if (is_object($links)) {
            Assert::isInstanceOf($links, ArticleLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links) ? new ArticleLinks($links) : $links;
        return $this;
    }

    /**
     * Get the meta
     * @return \Urbania\AppleNews\Api\Objects\Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set the meta
     * @param \Urbania\AppleNews\Api\Objects\Meta|array $meta
     * @return $this
     */
    public function setMeta($meta)
    {
        if (is_null($meta)) {
            $this->meta = null;
            return $this;
        }

        if (is_object($meta)) {
            Assert::isInstanceOf($meta, Meta::class);
        } else {
            Assert::isArray($meta);
        }

        $this->meta = is_array($meta) ? new Meta($meta) : $meta;
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
        if (isset($this->meta)) {
            $data['meta'] = is_object($this->meta)
                ? $this->meta->toArray()
                : $this->meta;
        }
        return $data;
    }
}
