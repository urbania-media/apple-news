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
     * @dataProvider stylesProvider
     * @covers ::getStyles
     * @covers ::setStyles
     */
    public function testPropertyStyles($value)
    {
        $object = new ComponentStyles();
        $object->setStyles($value);

        $this->assertEquals($value, $object->getStyles());
    }

    /**
     * Data provider for property styles
     */
    public function stylesProvider()
    {
        return [[["test" => new \Urbania\AppleNews\Format\ComponentStyle()]]];
    }
}
