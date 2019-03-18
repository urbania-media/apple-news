<?php

namespace Urbania\AppleNews\Api;

use Urbania\AppleNews\Api\Objects\ChannelResponse;
use Urbania\AppleNews\Api\Objects\ArticleResponse;
use Urbania\AppleNews\Article;

class ChannelsClient
{
    protected $client;
    protected $channelId;

    public function __construct(Client $client, $channelId = null)
    {
        $this->client = $client;
        $this->channelId = $channelId;
    }

    public function getChannel($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        $response = $this->client->makeRequest(
            sprintf('/channels/%s', $channelId)
        );

        return new ChannelResponse($response);
    }

    public function createArticle(
        Article $article,
        $channelId = null
    ) {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        $metadata = $article->getMetadata();

        $data = [
            [
                'name' => 'article.json',
                'contents' => json_encode($article),
                'filename' => 'article.json',
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ]
        ];

        if (!is_null($metadata)) {
            $data[] = [
                'name' => 'metadata',
                'contents' => json_encode($metadata),
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ];
        }

        $response = $this->client->makeRequest(
            sprintf('/channels/%s/articles', $channelId),
            'POST',
            $data
        );

        return new ArticleResponse($response);
    }
}
