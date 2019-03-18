<?php

use Urbania\AppleNews\ApiClient;
use Urbania\AppleNews\Article;

class FeatureTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $apiKey = getenv('APPLE_NEWS_API_KEY');
        $apiSecret = getenv('APPLE_NEWS_API_SECRET');
        $channelId = getenv('APPLE_NEWS_CHANNEL_ID');
        $this->client = new ApiClient($apiKey, $apiSecret);
        $this->channelsClient = $this->client->channels($channelId);
    }

    /**
     * Test the constructor
     *
     * @test
     */
    public function testApi()
    {
        $channel = $this->channelsClient->getChannel();
        dd($channel);
    }

    /**
     * Test building an article from a json file
     *
     * @test
     */
    public function testArticleFromJson()
    {
        $articleData = json_decode(file_get_contents(__DIR__.'/../fixture/article.json'), true);
        $article = Article::fromFile(__DIR__.'/../fixture/article.json');
        $this->assertEquals($articleData, $article->toArray());
    }

    /**
     * Test building an article from a json file
     *
     * @test
     */
    public function testCreateArticleFromJson()
    {
        $articleData = json_decode(file_get_contents(__DIR__.'/../fixture/article.json'), true);
        $article = Article::fromFile(__DIR__.'/../fixture/article.json');
        $articleResponse = $this->channelsClient->createArticle($article);
        dd($articleResponse);
    }
}
