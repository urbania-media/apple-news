<?php

use Urbania\AppleNews\Article;

class ArticleTest extends TestCase
{
    /**
     * Test building an article from a json file
     *
     * @test
     */
    public function testArticleFromJson()
    {
        $articlePath = realpath(__DIR__.'/../fixture/article.json');
        $articleData = json_decode(file_get_contents($articlePath), true);
        $article = Article::fromFile($articlePath);
        $this->assertEquals($articleData, $article->toArray());
    }

    /**
     * Test building an article from a json file
     *
     * @test
     */
    public function testArticleClone()
    {
        $articlePath = realpath(__DIR__.'/../fixture/article.json');
        $articleData = json_decode(file_get_contents($articlePath), true);
        $article = Article::fromFile($articlePath);
        $clonedArticle = clone $article;
        $this->assertFalse($article === $clonedArticle);
        $this->assertFalse($article->getDocument() === $clonedArticle->getDocument());
        $this->assertEquals($article->toArray(), $clonedArticle->toArray());
    }
}
