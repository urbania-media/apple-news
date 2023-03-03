<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ComponentAnimation;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ComponentAnimation
 */
class ComponentAnimationTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new ComponentAnimation();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [["appear"], ["fade_in"], ["move_in"], ["scale_fade"]];
    }
}
