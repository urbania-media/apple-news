<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * See the field returned by the promote article response.
 *
 * @see https://developer.apple.com/documentation/apple_news/promotearticleresponse
 */
class PromoteArticleResponse extends BaseSdkObject
{
    /**
     * List of URLs for the promoted articles.
     * @var string[]
     */
    protected $promotedArticles;

    public function __construct(array $data = [])
    {
        if (isset($data['promotedArticles'])) {
            $this->setPromotedArticles($data['promotedArticles']);
        }
    }

    /**
     * Add an item to promotedArticles
     * @param string $item
     * @return $this
     */
    public function addPromotedArticle($item)
    {
        return $this->setPromotedArticles(
            !is_null($this->promotedArticles)
                ? array_merge($this->promotedArticles, [$item])
                : [$item]
        );
    }

    /**
     * Add items to promotedArticles
     * @param array $items
     * @return $this
     */
    public function addPromotedArticles($items)
    {
        Assert::isArray($items);
        return $this->setPromotedArticles(
            !is_null($this->promotedArticles)
                ? array_merge($this->promotedArticles, $items)
                : $items
        );
    }

    /**
     * Get the promotedArticles
     * @return string[]
     */
    public function getPromotedArticles()
    {
        return $this->promotedArticles;
    }

    /**
     * Set the promotedArticles
     * @param string[] $promotedArticles
     * @return $this
     */
    public function setPromotedArticles($promotedArticles)
    {
        if (is_null($promotedArticles)) {
            $this->promotedArticles = null;
            return $this;
        }

        Assert::isArray($promotedArticles);
        Assert::allString($promotedArticles);

        $this->promotedArticles = $promotedArticles;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->promotedArticles)) {
            $data['promotedArticles'] = $this->promotedArticles;
        }
        return $data;
    }
}
