<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Divider;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Divider
 */
class DividerTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     * @covers ::setRole
     */
    public function testPropertyRole($value)
    {
        $object = new Divider();
        $object->setRole($value);

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property stroke
     * @test
     * @dataProvider strokeProvider
     * @covers ::getStroke
     * @covers ::setStroke
     */
    public function testPropertyStroke($value)
    {
        $object = new Divider();
        $object->setStroke($value);

        $this->assertEquals($value, $object->getStroke());
    }

    /**
     * Data provider for property stroke
     */
    public function strokeProvider()
    {
        return [[new \Urbania\AppleNews\Format\StrokeStyle()]];
    }
}
