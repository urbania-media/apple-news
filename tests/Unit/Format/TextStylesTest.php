<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TextStyles;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TextStyles
 */
class TextStylesTest extends TestCase
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
        $object = new TextStyles();
        $object->setStyles($value);

        $this->assertEquals($value, $object->getStyles());
    }

    /**
     * Data provider for property styles
     */
    public static function stylesProvider()
    {
        return [[["test" => new \Urbania\AppleNews\Format\TextStyle()]]];
    }
}
