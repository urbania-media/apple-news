<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\ChannelLinks;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\ChannelLinks
 */
class ChannelLinksTest extends TestCase
{
    /**
     * Test the property defaultSection
     * @test
     * @dataProvider defaultSectionProvider
     * @covers ::getDefaultSection
     * @covers ::setDefaultSection
     */
    public function testPropertyDefaultSection($value)
    {
        $object = new ChannelLinks();
        $object->setDefaultSection($value);

        $this->assertEquals($value, $object->getDefaultSection());
    }

    /**
     * Data provider for property defaultSection
     */
    public static function defaultSectionProvider()
    {
        return [['a string']];
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
        $object = new ChannelLinks();
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
