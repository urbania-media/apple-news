<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Issue;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Issue
 */
class IssueTest extends TestCase
{
    /**
     * Test the property identifier
     * @test
     * @dataProvider identifierProvider
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testPropertyIdentifier($value)
    {
        $object = new Issue();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property order
     * @test
     * @dataProvider orderProvider
     * @covers ::getOrder
     * @covers ::setOrder
     */
    public function testPropertyOrder($value)
    {
        $object = new Issue();
        $object->setOrder($value);

        $this->assertEquals($value, $object->getOrder());
    }

    /**
     * Data provider for property order
     */
    public static function orderProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property tocByline
     * @test
     * @dataProvider tocBylineProvider
     * @covers ::getTocByline
     * @covers ::setTocByline
     */
    public function testPropertyTocByline($value)
    {
        $object = new Issue();
        $object->setTocByline($value);

        $this->assertEquals($value, $object->getTocByline());
    }

    /**
     * Data provider for property tocByline
     */
    public static function tocBylineProvider()
    {
        return [['a string']];
    }
}
