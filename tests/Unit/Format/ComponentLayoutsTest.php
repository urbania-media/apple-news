<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ComponentLayouts;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ComponentLayouts
 */
class ComponentLayoutsTest extends TestCase
{
    /**
     * Test the property layouts
     * @test
     * @dataProvider layoutsProvider
     * @covers ::getLayouts
     * @covers ::setLayouts
     */
    public function testPropertyLayouts($value)
    {
        $object = new ComponentLayouts();
        $object->setLayouts($value);

        $this->assertEquals($value, $object->getLayouts());
    }

    /**
     * Data provider for property layouts
     */
    public static function layoutsProvider()
    {
        return [[["test" => new \Urbania\AppleNews\Format\ComponentLayout()]]];
    }
}
