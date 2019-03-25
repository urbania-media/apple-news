<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\SectionLinks;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\SectionLinks
 */
class SectionLinksTest extends TestCase
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
        $object = new SectionLinks();
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
     * Test the property self
     * @test
     * @dataProvider selfProvider
     * @covers ::getSelf
     * @covers ::setSelf
     */
    public function testPropertySelf($value)
    {
        $object = new SectionLinks();
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
