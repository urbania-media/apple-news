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
    public static function metaProvider()
    {
        return [[new \Urbania\AppleNews\Api\Objects\Meta()]];
    }
}
