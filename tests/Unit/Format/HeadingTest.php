<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Heading;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Heading
 */
class HeadingTest extends TestCase
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
        $object = new Heading();
        $object->setRole($value);

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [
            ["heading"],
            ["heading1"],
            ["heading2"],
            ["heading3"],
            ["heading4"],
            ["heading5"],
            ["heading6"]
        ];
    }
}
