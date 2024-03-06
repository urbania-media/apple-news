<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\LinkAddition;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\LinkAddition
 */
class LinkAdditionTest extends TestCase
{
    /**
     * Test the property rangeLength
     * @test
     * @dataProvider rangeLengthProvider
     * @covers ::getRangeLength
     * @covers ::setRangeLength
     */
    public function testPropertyRangeLength($value)
    {
        $object = new LinkAddition();
        $object->setRangeLength($value);

        $this->assertEquals($value, $object->getRangeLength());
    }

    /**
     * Data provider for property rangeLength
     */
    public static function rangeLengthProvider()
    {
        return [[1]];
    }

    /**
     * Test the property rangeStart
     * @test
     * @dataProvider rangeStartProvider
     * @covers ::getRangeStart
     * @covers ::setRangeStart
     */
    public function testPropertyRangeStart($value)
    {
        $object = new LinkAddition();
        $object->setRangeStart($value);

        $this->assertEquals($value, $object->getRangeStart());
    }

    /**
     * Data provider for property rangeStart
     */
    public static function rangeStartProvider()
    {
        return [[1]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new LinkAddition();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['link']];
    }

    /**
     * Test the property URL
     * @test
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new LinkAddition();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public static function URLProvider()
    {
        return [['http://example.com'], ['https://example.com']];
    }
}