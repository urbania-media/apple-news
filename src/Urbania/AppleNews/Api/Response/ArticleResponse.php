<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See which objects make up the publish article, read article, and
 * update article responses.
 *
 * @see https://developer.apple.com/documentation/apple_news/articleresponse
 */
class ArticleResponse extends Article
{
    /** @var \Urbania\AppleNews\Api\Response\ArticleLinks */
    protected $links;

    /** @var \Urbania\AppleNews\Api\Response\Meta */
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
     * @return \Urbania\AppleNews\Api\Response\ArticleLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Get the meta
     * @return \Urbania\AppleNews\Api\Response\Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Response\ArticleLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_object($links)) {
            Assert::isInstanceOf($links, ArticleLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links) ? new ArticleLinks($links) : $links;
        return $this;
    }

    /**
     * Set the meta
     * @param \Urbania\AppleNews\Api\Response\Meta|array $meta
     * @return $this
     */
    public function setMeta($meta)
    {
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
        return array_merge(parent::toArray(), [
            'links' => is_object($this->links)
                ? $this->links->toArray()
                : $this->links,
            'meta' => is_object($this->meta)
                ? $this->meta->toArray()
                : $this->meta
        ]);
    }
}
