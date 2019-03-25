<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\LinearGradientFill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\LinearGradientFill
 */
class LinearGradientFillTest extends TestCase
{
    /**
     * Test the property angle
     * @test
     * @dataProvider angleProvider
     * @covers ::getAngle
     * @covers ::setAngle
     */
    public function testPropertyAngle($value)
    {
        $object = new LinearGradientFill();
        $object->setAngle($value);

        $this->assertEquals($value, $object->getAngle());
    }

    /**
     * Data provider for property angle
     */
    public function angleProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new LinearGradientFill();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["linear_gradient"]];
    }
}
