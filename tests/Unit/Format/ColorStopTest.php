<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ColorStop;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ColorStop
 */
class ColorStopTest extends TestCase
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
        $object = new ColorStop();
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
     * Test the property location
     * @test
     * @dataProvider locationProvider
     * @covers ::getLocation
     * @covers ::setLocation
     */
    public function testPropertyLocation($value)
    {
        $object = new ColorStop();
        $object->setLocation($value);

        $this->assertEquals($value, $object->getLocation());
    }

    /**
     * Data provider for property location
     */
    public static function locationProvider()
    {
        return [[1.1], [1]];
    }
}
