<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Margin;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Margin
 */
class MarginTest extends TestCase
{
    /**
     * Test the property bottom
     * @test
     * @dataProvider bottomProvider
     * @covers ::getBottom
     * @covers ::setBottom
     */
    public function testPropertyBottom($value)
    {
        $object = new Margin();
        $object->setBottom($value);

        $this->assertEquals($value, $object->getBottom());
    }

    /**
     * Data provider for property bottom
     */
    public static function bottomProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }

    /**
     * Test the property top
     * @test
     * @dataProvider topProvider
     * @covers ::getTop
     * @covers ::setTop
     */
    public function testPropertyTop($value)
    {
        $object = new Margin();
        $object->setTop($value);

        $this->assertEquals($value, $object->getTop());
    }

    /**
     * Data provider for property top
     */
    public static function topProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }
}
