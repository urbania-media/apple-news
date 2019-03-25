<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Shadow;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Shadow
 */
class ShadowTest extends TestCase
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
        $object = new Shadow();
        $object->setColor($value);

        $this->assertEquals($value, $object->getColor());
    }

    /**
     * Data provider for property color
     */
    public function colorProvider()
    {
        return [["#fff"], ["#000"]];
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
        $object = new Shadow();
        $object->setOffset($value);

        $this->assertEquals($value, $object->getOffset());
    }

    /**
     * Data provider for property offset
     */
    public function offsetProvider()
    {
        return [[new \Urbania\AppleNews\Format\Offset()]];
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
        $object = new Shadow();
        $object->setOpacity($value);

        $this->assertEquals($value, $object->getOpacity());
    }

    /**
     * Data provider for property opacity
     */
    public function opacityProvider()
    {
        return [[1.1], [1]];
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
        $object = new Shadow();
        $object->setRadius($value);

        $this->assertEquals($value, $object->getRadius());
    }

    /**
     * Data provider for property radius
     */
    public function radiusProvider()
    {
        return [[1.1], [1]];
    }
}
