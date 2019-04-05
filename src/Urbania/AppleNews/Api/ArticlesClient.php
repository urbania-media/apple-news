<?php

namespace Urbania\AppleNews\Api;

use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Api\Objects\ArticleResponse;
use Urbania\AppleNews\Article;

class ArticlesClient
{
    protected $client;
    protected $channelId;

    public function __construct(Client $client, $channelId = null)
    {
        $this->client = $client;
        $this->channelId = $channelId;
    }

    /**
     * Find an article by the ID
     * @param  string $articleId The article ID
     * @return ArticleResponse The article
     */
    public function find($articleId)
    {
        Assert::uuid($articleId);

        $response = $this->client->makeRequest(
            sprintf('/articles/%s', $articleId)
        );

        $response->setObjectType(ArticleResponse::class);

        return $response;
    }

    /**
     * Search ofr article in a channel
     * @param  array  $query     The query parameters
     * @param  string $channelId The channel ID
     * @return ArticleResponse The list of articles
     */
    public function search(array $query = [], $channelId = null)
    {
        Assert::searchArticlesQuery($query);

        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        $response = $this->client->makeRequest(
            sprintf('/channels/%s/articles', $channelId),
            'GET',
            $query
        );

        $response->setObjectType(ArticleResponse::class, true);

        return $response;
    }

    /**
     * Create an Article
     * @param  Article $article   The article object
     * @param  string  $channelId The channel ID
     * @return ArticleResponse The new article
     */
    public function create(Article $article, $channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        Assert::uuid($channelId);

        $response = $this->client->makeRequest(
            sprintf('/channels/%s/articles', $channelId),
            'POST',
            $article->getMultipartBody()
        );

        $response->setObjectType(ArticleResponse::class);

        return $response;
    }

    /**
     * Update an Article
     * @param  Article $article   The article object
     * @return ArticleResponse The updated article
     */
    public function update(Article $article, $articleId = null)
    {
        if (is_null($articleId)) {
            $articleId = $article->getId();
        }

        Assert::uuid($articleId);

        $response = $this->client->makeRequest(
            sprintf('/articles/%s', $articleId),
            'POST',
            $article->getMultipartBody()
        );

        $response->setObjectType(ArticleResponse::class);

        return $response;
    }
}
