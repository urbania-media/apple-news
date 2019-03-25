<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\PromoteArticleResponse;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\PromoteArticleResponse
 */
class PromoteArticleResponseTest extends TestCase
{
    /**
     * Test the property promotedArticles
     * @test
     * @dataProvider promotedArticlesProvider
     * @covers ::getPromotedArticles
     * @covers ::setPromotedArticles
     */
    public function testPropertyPromotedArticles($value)
    {
        $object = new PromoteArticleResponse();
        $object->setPromotedArticles($value);

        $this->assertEquals($value, $object->getPromotedArticles());
    }

    /**
     * Data provider for property promotedArticles
     */
    public function promotedArticlesProvider()
    {
        return [[[]]];
    }
}
