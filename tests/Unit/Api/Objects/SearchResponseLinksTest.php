<?php

namespace Urbania\AppleNews\Tests\Unit\Api\Objects;

use Urbania\AppleNews\Api\Objects\SearchResponseLinks;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Api\Objects\SearchResponseLinks
 */
class SearchResponseLinksTest extends TestCase
{
    /**
     * Test the property self
     * @test
     * @dataProvider selfProvider
     * @covers ::getSelf
     * @covers ::setSelf
     */
    public function testPropertySelf($value)
    {
        $object = new SearchResponseLinks();
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

    /**
     * Test the property next
     * @test
     * @dataProvider nextProvider
     * @covers ::getNext
     * @covers ::setNext
     */
    public function testPropertyNext($value)
    {
        $object = new SearchResponseLinks();
        $object->setNext($value);

        $this->assertEquals($value, $object->getNext());
    }

    /**
     * Data provider for property next
     */
    public static function nextProvider()
    {
        return [['a string']];
    }
}
