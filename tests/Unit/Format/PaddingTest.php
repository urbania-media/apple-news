<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Padding;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Padding
 */
class PaddingTest extends TestCase
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
        $object = new Padding();
        $object->setBottom($value);

        $this->assertEquals($value, $object->getBottom());
    }

    /**
     * Data provider for property bottom
     */
    public static function bottomProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property left
     * @test
     * @dataProvider leftProvider
     * @covers ::getLeft
     * @covers ::setLeft
     */
    public function testPropertyLeft($value)
    {
        $object = new Padding();
        $object->setLeft($value);

        $this->assertEquals($value, $object->getLeft());
    }

    /**
     * Data provider for property left
     */
    public static function leftProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }

    /**
     * Test the property right
     * @test
     * @dataProvider rightProvider
     * @covers ::getRight
     * @covers ::setRight
     */
    public function testPropertyRight($value)
    {
        $object = new Padding();
        $object->setRight($value);

        $this->assertEquals($value, $object->getRight());
    }

    /**
     * Data provider for property right
     */
    public static function rightProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
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
        $object = new Padding();
        $object->setTop($value);

        $this->assertEquals($value, $object->getTop());
    }

    /**
     * Data provider for property top
     */
    public static function topProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }
}
