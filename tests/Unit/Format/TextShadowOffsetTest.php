<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TextShadowOffset;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TextShadowOffset
 */
class TextShadowOffsetTest extends TestCase
{
    /**
     * Test the property x
     * @test
     * @dataProvider xProvider
     * @covers ::getX
     * @covers ::setX
     */
    public function testPropertyX($value)
    {
        $object = new TextShadowOffset();
        $object->setX($value);

        $this->assertEquals($value, $object->getX());
    }

    /**
     * Data provider for property x
     */
    public static function xProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property y
     * @test
     * @dataProvider yProvider
     * @covers ::getY
     * @covers ::setY
     */
    public function testPropertyY($value)
    {
        $object = new TextShadowOffset();
        $object->setY($value);

        $this->assertEquals($value, $object->getY());
    }

    /**
     * Data provider for property y
     */
    public static function yProvider()
    {
        return [[1.1], [1]];
    }
}
