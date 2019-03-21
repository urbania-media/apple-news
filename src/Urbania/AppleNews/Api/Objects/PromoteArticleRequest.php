<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the required field for the promote article request.
 *
 * @see https://developer.apple.com/documentation/apple_news/promotearticlerequest
 */
class PromoteArticleRequest extends BaseSdkObject
{
    /**
     * List of article UUIDs to be promoted for the specified section. This
     * list may be empty.
     * @var string[]
     */
    protected $articleIds = [];

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
        return $this->setArticleIds(array_merge($this->articleIds, [$item]));
    }

    /**
     * Add items to articleIds
     * @param array $items
     * @return $this
     */
    public function addArticleIds($items)
    {
        Assert::isArray($items);
        return $this->setArticleIds(array_merge($this->articleIds, $items));
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
