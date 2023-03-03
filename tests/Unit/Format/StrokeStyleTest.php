<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\StrokeStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\StrokeStyle
 */
class StrokeStyleTest extends TestCase
{
    /**
     * Test the property color
     * @test
     * @dataProvider colorProvider
     * @covers ::getColor
     * @covers ::setColor
     */
    public function testPropertyColor($value)
    {
        $object = new StrokeStyle();
        $object->setColor($value);

        $this->assertEquals($value, $object->getColor());
    }

    /**
     * Data provider for property color
     */
    public static function colorProvider()
    {
        return [["#fff"], ["#000"]];
    }

    /**
     * Test the property style
     * @test
     * @dataProvider styleProvider
     * @covers ::getStyle
     * @covers ::setStyle
     */
    public function testPropertyStyle($value)
    {
        $object = new StrokeStyle();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public static function styleProvider()
    {
        return [["solid"], ["dashed"], ["dotted"]];
    }

    /**
     * Test the property width
     * @test
     * @dataProvider widthProvider
     * @covers ::getWidth
     * @covers ::setWidth
     */
    public function testPropertyWidth($value)
    {
        $object = new StrokeStyle();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public static function widthProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }
}
