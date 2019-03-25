<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\InlineTextStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\InlineTextStyle
 */
class InlineTextStyleTest extends TestCase
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
        $object = new InlineTextStyle();
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
        $object = new InlineTextStyle();
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

    /**
     * Test the property textStyle
     * @test
     * @dataProvider textStyleProvider
     * @covers ::getTextStyle
     * @covers ::setTextStyle
     */
    public function testPropertyTextStyle($value)
    {
        $object = new InlineTextStyle();
        $object->setTextStyle($value);

        $this->assertEquals($value, $object->getTextStyle());
    }

    /**
     * Data provider for property textStyle
     */
    public function textStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextStyle()]];
    }
}
