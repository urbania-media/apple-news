<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Addition;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Addition
 */
class AdditionTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new Addition();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [["a string"]];
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
        $object = new Addition();
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
        $object = new Addition();
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
}
