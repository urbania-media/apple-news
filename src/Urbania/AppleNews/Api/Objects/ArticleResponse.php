<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See which objects make up the Create an Article, Read an Article, and
 * Update an Article responses.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articleresponse.json
 */
class ArticleResponse extends Article
{
    /** @var \Urbania\AppleNews\Api\Objects\Meta */
    protected $meta;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['meta'])) {
            $this->setMeta($data['meta']);
        }
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

        Assert::isSdkObject($meta, Meta::class);

        $this->meta = Utils::isAssociativeArray($meta) ? new Meta($meta) : $meta;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->meta)) {
            $data['meta'] = $this->meta instanceof Arrayable ? $this->meta->toArray() : $this->meta;
        }
        return $data;
    }
}
