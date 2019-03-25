<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Body;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Body
 */
class BodyTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Body();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["body"]];
    }
}
