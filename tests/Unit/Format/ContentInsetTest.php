<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ContentInset;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ContentInset
 */
class ContentInsetTest extends TestCase
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
        $object = new ContentInset();
        $object->setBottom($value);

        $this->assertEquals($value, $object->getBottom());
    }

    /**
     * Data provider for property bottom
     */
    public function bottomProvider()
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
        $object = new ContentInset();
        $object->setLeft($value);

        $this->assertEquals($value, $object->getLeft());
    }

    /**
     * Data provider for property left
     */
    public function leftProvider()
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
        $object = new ContentInset();
        $object->setRight($value);

        $this->assertEquals($value, $object->getRight());
    }

    /**
     * Data provider for property right
     */
    public function rightProvider()
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
        $object = new ContentInset();
        $object->setTop($value);

        $this->assertEquals($value, $object->getTop());
    }

    /**
     * Data provider for property top
     */
    public function topProvider()
    {
        return [[true], [false]];
    }
}
