<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Link;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Link
 */
class LinkTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new Link();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["link"]];
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
        $object = new Link();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public function URLProvider()
    {
        return [["http://example.com"], ["https://example.com"]];
    }

    /**
     * Test the property rangeLength
     * @test
     * @dataProvider rangeLengthProvider
     * @covers ::getRangeLength
     * @covers ::setRangeLength
     */
    public function testPropertyRangeLength($value)
    {
        $object = new Link();
        $object->setRangeLength($value);

        $this->assertEquals($value, $object->getRangeLength());
    }

    /**
     * Data provider for property rangeLength
     */
    public function rangeLengthProvider()
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
        $object = new Link();
        $object->setRangeStart($value);

        $this->assertEquals($value, $object->getRangeStart());
    }

    /**
     * Data provider for property rangeStart
     */
    public function rangeStartProvider()
    {
        return [[1]];
    }
}
