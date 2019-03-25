<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Offset;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Offset
 */
class OffsetTest extends TestCase
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
        $object = new Offset();
        $object->setX($value);

        $this->assertEquals($value, $object->getX());
    }

    /**
     * Data provider for property x
     */
    public function xProvider()
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
        $object = new Offset();
        $object->setY($value);

        $this->assertEquals($value, $object->getY());
    }

    /**
     * Data provider for property y
     */
    public function yProvider()
    {
        return [[1.1], [1]];
    }
}
