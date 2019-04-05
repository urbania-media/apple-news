<?php

namespace Urbania\AppleNews\Api;

use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Api\Objects\SectionResponse;
use Urbania\AppleNews\Api\Objects\PromoteArticleResponse;
use Urbania\AppleNews\Article;

class SectionsClient
{
    protected $client;
    protected $channelId;

    public function __construct(Client $client, $channelId = null)
    {
        $this->client = $client;
        $this->channelId = $channelId;
    }

    /**
     * Find a section by the ID
     * @param  string $sectionId The section ID
     * @return SectionResponse The section
     */
    public function find($sectionId)
    {
        Assert::uuid($sectionId);

        $response = $this->client->makeRequest(
            sprintf('/sections/%s', $sectionId)
        );

        $response->setObjectType(SectionResponse::class);

        return $response;
    }

    public function get($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        $response = $this->client->makeRequest(
            sprintf('/channels/%s/sections', $channelId)
        );

        $response->setObjectType(SectionResponse::class, true);

        return $response;
    }

    public function getPromotedArticles($sectionId)
    {
        Assert::uuid($sectionId);

        $response = $this->client->makeRequest(
            sprintf('/sections/%s/promotedArticles', $sectionId)
        );

        $response->setObjectType(PromoteArticleResponse::class, true);

        return $response;
    }

    public function promoteArticles($articles)
    {
        Assert::isArray($articles);

        $response = $this->client->makeRequest(
            sprintf('/sections/%s/promotedArticles', $sectionId),
            'POST'
        );

        $response->setObjectType(PromoteArticleResponse::class, true);

        return $response;
    }
}
