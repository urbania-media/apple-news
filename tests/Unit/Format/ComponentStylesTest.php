<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ComponentStyles;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ComponentStyles
 */
class ComponentStylesTest extends TestCase
{
    /**
     * Test the property styles
     * @test
     * @covers ::getStyles
     * @covers ::setStyles
     */
    public function testProperyStyles()
    {
        $value = ["test" => new \Urbania\AppleNews\Format\ComponentStyle()];
        $object = new ComponentStyles();
        $object->setStyles($value);

        $this->assertEquals($value, $object->getStyles());
    }
}
