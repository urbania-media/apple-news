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
     * @covers ::getType
     * @covers ::setType
     */
    public function testProperyType()
    {
        $value = "a string";
        $object = new ComponentAnimation();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }
}
