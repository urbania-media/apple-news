<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the required field for the Promote an Article request.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/promotearticlerequest.json
 */
class PromoteArticleRequest extends BaseSdkObject
{
    /**
     * The list of article UUIDs you want to promote for the specified
     * section.
     * @var string[]
     */
    protected $articleIds;

    public function __construct(array $data = [])
    {
        if (isset($data['articleIds'])) {
            $this->setArticleIds($data['articleIds']);
        }
    }

    /**
     * Add an item to articleIds
     * @param string $item
     * @return $this
     */
    public function addArticleId($item)
    {
        return $this->setArticleIds(
            !is_null($this->articleIds) ? array_merge($this->articleIds, [$item]) : [$item]
        );
    }

    /**
     * Add items to articleIds
     * @param array $items
     * @return $this
     */
    public function addArticleIds($items)
    {
        Assert::isArray($items);
        return $this->setArticleIds(
            !is_null($this->articleIds) ? array_merge($this->articleIds, $items) : $items
        );
    }

    /**
     * Get the articleIds
     * @return string[]
     */
    public function getArticleIds()
    {
        return $this->articleIds;
    }

    /**
     * Set the articleIds
     * @param string[] $articleIds
     * @return $this
     */
    public function setArticleIds($articleIds)
    {
        Assert::isArray($articleIds);
        Assert::allString($articleIds);

        $this->articleIds = $articleIds;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->articleIds)) {
            $data['articleIds'] = $this->articleIds;
        }
        return $data;
    }
}
