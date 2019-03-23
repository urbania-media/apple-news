<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Behavior;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Behavior
 */
class BehaviorTest extends TestCase
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
        $object = new Behavior();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }
}
