<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\FadingStickyHeader;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\FadingStickyHeader
 */
class FadingStickyHeaderTest extends TestCase
{
    /**
     * Test the property fadeColor
     * @test
     * @dataProvider fadeColorProvider
     * @covers ::getFadeColor
     * @covers ::setFadeColor
     */
    public function testPropertyFadeColor($value)
    {
        $object = new FadingStickyHeader();
        $object->setFadeColor($value);

        $this->assertEquals($value, $object->getFadeColor());
    }

    /**
     * Data provider for property fadeColor
     */
    public static function fadeColorProvider()
    {
        return [['#fff'], ['#000']];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new FadingStickyHeader();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [['fading_sticky_header']];
    }
}
