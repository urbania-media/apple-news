<?php

namespace Urbania\AppleNews\Api;

use Urbania\AppleNews\Api\Objects\ChannelResponse;
use Urbania\AppleNews\Api\Objects\ArticleResponse;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Support\Assert;

class ChannelsClient
{
    protected $client;
    protected $channelId;

    public function __construct(Client $client, $channelId = null)
    {
        $this->client = $client;
        $this->channelId = $channelId;
    }

    /**
     * Find a channel by the ID
     * @param  string $channelId The channel ID
     * @return ChannelResponse The channel
     */
    public function find($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        $response = $this->client->makeRequest(
            sprintf('/channels/%s', $channelId)
        );

        $response->setObjectType(ChannelResponse::class);

        return $response;
    }

    /**
     * Get an articles client
     * @param  string $channelId The channel ID
     * @return ArticlesClient The client
     */
    public function articles($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        return new ArticlesClient($this->client, $channelId);
    }

    /**
     * Create an article
     * @param  Article $article The article
     * @param  string $channelId The channel ID
     * @return ArticleResponse The article
     */
    public function createArticle(Article $article, $channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        return $this->articles($channelId)->create($article);
    }

    /**
     * Search for articles
     * @param  array $query The search query
     * @param  string $channelId The channel ID
     * @return ArticleResponse The articles
     */
    public function searchArticles(array $query = [], $channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        return $this->articles($channelId)->search($query, $channelId);
    }
}
