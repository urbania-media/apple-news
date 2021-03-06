<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\ArticleLinks;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\ArticleLinks
 */
class ArticleLinksTest extends TestCase
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
        $object = new ArticleLinks();
        $object->setChannel($value);

        $this->assertEquals($value, $object->getChannel());
    }

    /**
     * Data provider for property channel
     */
    public function channelProvider()
    {
        return [["a string"]];
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
        $object = new ArticleLinks();
        $object->setSections($value);

        $this->assertEquals($value, $object->getSections());
    }

    /**
     * Data provider for property sections
     */
    public function sectionsProvider()
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
        $object = new ArticleLinks();
        $object->setSelf($value);

        $this->assertEquals($value, $object->getSelf());
    }

    /**
     * Data provider for property self
     */
    public function selfProvider()
    {
        return [["a string"]];
    }
}
