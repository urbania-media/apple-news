<?php

use Urbania\AppleNews\Api;
use Urbania\AppleNews\Article;
use Urbania\AppleNews\Parsers\WordpressParser;

class FeatureTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $apiKey = getenv('APPLE_NEWS_API_KEY');
        $apiSecret = getenv('APPLE_NEWS_API_SECRET');
        $channelId = getenv('APPLE_NEWS_CHANNEL_ID');
        $this->client = new Api($apiKey, $apiSecret);
        $this->channelsClient = $this->client->channels($channelId);
    }

    /**
     * Test the constructor
     *
     * @test
     */
    public function testApi()
    {
        // $channel = $this->channelsClient->find();
        $articles = $this->channelsClient->searchArticles();
        dd($articles);
    }

    /**
     * Test the constructor
     *
     * @test
     */
    public function testWordpress()
    {
        $parser = new WordpressParser('https://urbania.ca');
        $article = $parser->parse('https://urbania.ca/?p=305581');
        dd($article->toJson());
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
        $article = Article::fromFile(__DIR__.'/../fixture/article.json');
        $articleResponse = $this->channelsClient->createArticle($article);
        dd($articleResponse);
    }
}
