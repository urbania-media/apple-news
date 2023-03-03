<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\CornerMask;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\CornerMask
 */
class CornerMaskTest extends TestCase
{
    /**
     * Test the property bottomLeft
     * @test
     * @dataProvider bottomLeftProvider
     * @covers ::getBottomLeft
     * @covers ::setBottomLeft
     */
    public function testPropertyBottomLeft($value)
    {
        $object = new CornerMask();
        $object->setBottomLeft($value);

        $this->assertEquals($value, $object->getBottomLeft());
    }

    /**
     * Data provider for property bottomLeft
     */
    public static function bottomLeftProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property bottomRight
     * @test
     * @dataProvider bottomRightProvider
     * @covers ::getBottomRight
     * @covers ::setBottomRight
     */
    public function testPropertyBottomRight($value)
    {
        $object = new CornerMask();
        $object->setBottomRight($value);

        $this->assertEquals($value, $object->getBottomRight());
    }

    /**
     * Data provider for property bottomRight
     */
    public static function bottomRightProvider()
    {
        return [[true], [false]];
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
        $object = new CornerMask();
        $object->setRadius($value);

        $this->assertEquals($value, $object->getRadius());
    }

    /**
     * Data provider for property radius
     */
    public static function radiusProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }

    /**
     * Test the property topLeft
     * @test
     * @dataProvider topLeftProvider
     * @covers ::getTopLeft
     * @covers ::setTopLeft
     */
    public function testPropertyTopLeft($value)
    {
        $object = new CornerMask();
        $object->setTopLeft($value);

        $this->assertEquals($value, $object->getTopLeft());
    }

    /**
     * Data provider for property topLeft
     */
    public static function topLeftProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property topRight
     * @test
     * @dataProvider topRightProvider
     * @covers ::getTopRight
     * @covers ::setTopRight
     */
    public function testPropertyTopRight($value)
    {
        $object = new CornerMask();
        $object->setTopRight($value);

        $this->assertEquals($value, $object->getTopRight());
    }

    /**
     * Data provider for property topRight
     */
    public static function topRightProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new CornerMask();
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
}
