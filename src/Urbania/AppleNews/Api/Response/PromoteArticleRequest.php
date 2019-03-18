<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the required field for the promote article request.
 *
 * @see https://developer.apple.com/documentation/apple_news/promotearticlerequest
 */
class PromoteArticleRequest
{
    /**
     * List of article UUIDs to be promoted for the specified section. This
     * list may be empty.
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
        return [
            'articleIds' => $this->articleIds ?? []
        ];
    }
}
