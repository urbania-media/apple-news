<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\SearchResponse;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\SearchResponse
 */
class SearchResponseTest extends TestCase
{
    /**
     * Test the property articles
     * @test
     * @dataProvider articlesProvider
     * @covers ::getArticles
     * @covers ::setArticles
     */
    public function testPropertyArticles($value)
    {
        $object = new SearchResponse();
        $object->setArticles($value);

        $this->assertEquals($value, $object->getArticles());
    }

    /**
     * Data provider for property articles
     */
    public static function articlesProvider()
    {
        return [[[new \Urbania\AppleNews\Api\Objects\Article()]]];
    }

    /**
     * Test the property links
     * @test
     * @dataProvider linksProvider
     * @covers ::getLinks
     * @covers ::setLinks
     */
    public function testPropertyLinks($value)
    {
        $object = new SearchResponse();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public static function linksProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\SearchResponseLinks()]];
    }

    /**
     * Test the property meta
     * @test
     * @dataProvider metaProvider
     * @covers ::getMeta
     * @covers ::setMeta
     */
    public function testPropertyMeta($value)
    {
        $object = new SearchResponse();
        $object->setMeta($value);

        $this->assertEquals($value, $object->getMeta());
    }

    /**
     * Data provider for property meta
     */
    public static function metaProvider()
    {
        return [['a string']];
    }
}
