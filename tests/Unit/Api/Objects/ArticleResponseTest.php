<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\ArticleResponse;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\ArticleResponse
 */
class ArticleResponseTest extends TestCase
{
    /**
     * Test the property links
     * @test
     * @dataProvider linksProvider
     * @covers ::getLinks
     * @covers ::setLinks
     */
    public function testPropertyLinks($value)
    {
        $object = new ArticleResponse();
        $object->setLinks($value);

        $this->assertEquals($value, $object->getLinks());
    }

    /**
     * Data provider for property links
     */
    public function linksProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\ArticleLinks()]];
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
        $object = new ArticleResponse();
        $object->setMeta($value);

        $this->assertEquals($value, $object->getMeta());
    }

    /**
     * Data provider for property meta
     */
    public function metaProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\Meta()]];
    }
}
