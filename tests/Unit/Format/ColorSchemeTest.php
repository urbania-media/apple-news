<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ColorScheme;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ColorScheme
 */
class ColorSchemeTest extends TestCase
{
    /**
     * Test the property automaticDarkModeEnabled
     * @test
     * @dataProvider automaticDarkModeEnabledProvider
     * @covers ::getAutomaticDarkModeEnabled
     * @covers ::setAutomaticDarkModeEnabled
     */
    public function testPropertyAutomaticDarkModeEnabled($value)
    {
        $object = new ColorScheme();
        $object->setAutomaticDarkModeEnabled($value);

        $this->assertEquals($value, $object->getAutomaticDarkModeEnabled());
    }

    /**
     * Data provider for property automaticDarkModeEnabled
     */
    public static function automaticDarkModeEnabledProvider()
    {
        return [[true], [false]];
    }
}
