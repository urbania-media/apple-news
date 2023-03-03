<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TextStrokeStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TextStrokeStyle
 */
class TextStrokeStyleTest extends TestCase
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
        $object = new TextStrokeStyle();
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
     * Test the property width
     * @test
     * @dataProvider widthProvider
     * @covers ::getWidth
     * @covers ::setWidth
     */
    public function testPropertyWidth($value)
    {
        $object = new TextStrokeStyle();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public static function widthProvider()
    {
        return [[1]];
    }
}
