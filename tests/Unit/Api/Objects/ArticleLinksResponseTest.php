<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\ArticleLinksResponse;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\ArticleLinksResponse
 */
class ArticleLinksResponseTest extends TestCase
{
    /**
     * Test the property channel
     * @test
     * @dataProvider channelProvider
     * @covers ::getChannel
     * @covers ::setChannel
     */
    public function testPropertyChannel($value)
    {
        $object = new ArticleLinksResponse();
        $object->setChannel($value);

        $this->assertEquals($value, $object->getChannel());
    }

    /**
     * Data provider for property channel
     */
    public static function channelProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property sections
     * @test
     * @dataProvider sectionsProvider
     * @covers ::getSections
     * @covers ::setSections
     */
    public function testPropertySections($value)
    {
        $object = new ArticleLinksResponse();
        $object->setSections($value);

        $this->assertEquals($value, $object->getSections());
    }

    /**
     * Data provider for property sections
     */
    public static function sectionsProvider()
    {
        return [[[]]];
    }

    /**
     * Test the property self
     * @test
     * @dataProvider selfProvider
     * @covers ::getSelf
     * @covers ::setSelf
     */
    public function testPropertySelf($value)
    {
        $object = new ArticleLinksResponse();
        $object->setSelf($value);

        $this->assertEquals($value, $object->getSelf());
    }

    /**
     * Data provider for property self
     */
    public static function selfProvider()
    {
        return [['a string']];
    }
}
