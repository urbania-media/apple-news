<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableBorder;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableBorder
 */
class TableBorderTest extends TestCase
{
    /**
     * Test the property all
     * @test
     * @covers ::getAll
     * @covers ::setAll
     */
    public function testProperyAll()
    {
        $value = new \Urbania\AppleNews\Format\TableStrokeStyle();
        $object = new TableBorder();
        $object->setAll($value);

        $this->assertEquals($value, $object->getAll());
    }

    /**
     * Test the property bottom
     * @test
     * @covers ::getBottom
     * @covers ::setBottom
     */
    public function testProperyBottom()
    {
        $value = null;
        $object = new TableBorder();
        $object->setBottom($value);

        $this->assertEquals($value, $object->getBottom());
    }

    /**
     * Test the property left
     * @test
     * @covers ::getLeft
     * @covers ::setLeft
     */
    public function testProperyLeft()
    {
        $value = null;
        $object = new TableBorder();
        $object->setLeft($value);

        $this->assertEquals($value, $object->getLeft());
    }

    /**
     * Test the property right
     * @test
     * @covers ::getRight
     * @covers ::setRight
     */
    public function testProperyRight()
    {
        $value = null;
        $object = new TableBorder();
        $object->setRight($value);

        $this->assertEquals($value, $object->getRight());
    }

    /**
     * Test the property top
     * @test
     * @covers ::getTop
     * @covers ::setTop
     */
    public function testProperyTop()
    {
        $value = null;
        $object = new TableBorder();
        $object->setTop($value);

        $this->assertEquals($value, $object->getTop());
    }
}
