<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Border;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Border
 */
class BorderTest extends TestCase
{
    /**
     * Test the property all
     * @test
     * @dataProvider allProvider
     * @covers ::getAll
     * @covers ::setAll
     */
    public function testPropertyAll($value)
    {
        $object = new Border();
        $object->setAll($value);

        $this->assertEquals($value, $object->getAll());
    }

    /**
     * Data provider for property all
     */
    public static function allProvider()
    {
        return [[new \Urbania\AppleNews\Format\StrokeStyle()]];
    }

    /**
     * Test the property bottom
     * @test
     * @dataProvider bottomProvider
     * @covers ::getBottom
     * @covers ::setBottom
     */
    public function testPropertyBottom($value)
    {
        $object = new Border();
        $object->setBottom($value);

        $this->assertEquals($value, $object->getBottom());
    }

    /**
     * Data provider for property bottom
     */
    public static function bottomProvider()
    {
        return [[true], [false]];
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
        $object = new Border();
        $object->setLeft($value);

        $this->assertEquals($value, $object->getLeft());
    }

    /**
     * Data provider for property left
     */
    public static function leftProvider()
    {
        return [[true], [false]];
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
        $object = new Border();
        $object->setRight($value);

        $this->assertEquals($value, $object->getRight());
    }

    /**
     * Data provider for property right
     */
    public static function rightProvider()
    {
        return [[true], [false]];
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
        $object = new Border();
        $object->setTop($value);

        $this->assertEquals($value, $object->getTop());
    }

    /**
     * Data provider for property top
     */
    public static function topProvider()
    {
        return [[true], [false]];
    }
}
