<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Layout;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Layout
 */
class LayoutTest extends TestCase
{
    /**
     * Test the property columns
     * @test
     * @dataProvider columnsProvider
     * @covers ::getColumns
     * @covers ::setColumns
     */
    public function testPropertyColumns($value)
    {
        $object = new Layout();
        $object->setColumns($value);

        $this->assertEquals($value, $object->getColumns());
    }

    /**
     * Data provider for property columns
     */
    public function columnsProvider()
    {
        return [[1]];
    }

    /**
     * Test the property gutter
     * @test
     * @dataProvider gutterProvider
     * @covers ::getGutter
     * @covers ::setGutter
     */
    public function testPropertyGutter($value)
    {
        $object = new Layout();
        $object->setGutter($value);

        $this->assertEquals($value, $object->getGutter());
    }

    /**
     * Data provider for property gutter
     */
    public function gutterProvider()
    {
        return [[1]];
    }

    /**
     * Test the property margin
     * @test
     * @dataProvider marginProvider
     * @covers ::getMargin
     * @covers ::setMargin
     */
    public function testPropertyMargin($value)
    {
        $object = new Layout();
        $object->setMargin($value);

        $this->assertEquals($value, $object->getMargin());
    }

    /**
     * Data provider for property margin
     */
    public function marginProvider()
    {
        return [[1]];
    }

    /**
     * Test the property width
     * @test
     * @dataProvider widthProvider
     * @covers ::getWidth
     * @covers ::setWidth
     */
    public function testPropertyWidth($value)
    {
        $object = new Layout();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public function widthProvider()
    {
        return [[1]];
    }
}
