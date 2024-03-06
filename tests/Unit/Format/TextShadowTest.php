<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TextShadow;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TextShadow
 */
class TextShadowTest extends TestCase
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
        $object = new TextShadow();
        $object->setColor($value);

        $this->assertEquals($value, $object->getColor());
    }

    /**
     * Data provider for property color
     */
    public static function colorProvider()
    {
        return [['#fff'], ['#000']];
    }

    /**
     * Test the property radius
     * @test
     * @dataProvider radiusProvider
     * @covers ::getRadius
     * @covers ::setRadius
     */
    public function testPropertyRadius($value)
    {
        $object = new TextShadow();
        $object->setRadius($value);

        $this->assertEquals($value, $object->getRadius());
    }

    /**
     * Data provider for property radius
     */
    public static function radiusProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property offset
     * @test
     * @dataProvider offsetProvider
     * @covers ::getOffset
     * @covers ::setOffset
     */
    public function testPropertyOffset($value)
    {
        $object = new TextShadow();
        $object->setOffset($value);

        $this->assertEquals($value, $object->getOffset());
    }

    /**
     * Data provider for property offset
     */
    public static function offsetProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextShadowOffset()]];
    }

    /**
     * Test the property opacity
     * @test
     * @dataProvider opacityProvider
     * @covers ::getOpacity
     * @covers ::setOpacity
     */
    public function testPropertyOpacity($value)
    {
        $object = new TextShadow();
        $object->setOpacity($value);

        $this->assertEquals($value, $object->getOpacity());
    }

    /**
     * Data provider for property opacity
     */
    public static function opacityProvider()
    {
        return [[1.1]];
    }
}
