<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Motion;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Motion
 */
class MotionTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @covers ::getType
     */
    public function testProperyType()
    {
        $value = "motion";
        $object = new Motion();

        $this->assertEquals($value, $object->getType());
    }
}
