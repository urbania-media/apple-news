<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableColumnSelector;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableColumnSelector
 */
class TableColumnSelectorTest extends TestCase
{
    /**
     * Test the property columnIndex
     * @test
     * @dataProvider columnIndexProvider
     * @covers ::getColumnIndex
     * @covers ::setColumnIndex
     */
    public function testPropertyColumnIndex($value)
    {
        $object = new TableColumnSelector();
        $object->setColumnIndex($value);

        $this->assertEquals($value, $object->getColumnIndex());
    }

    /**
     * Data provider for property columnIndex
     */
    public static function columnIndexProvider()
    {
        return [[1]];
    }

    /**
     * Test the property descriptor
     * @test
     * @dataProvider descriptorProvider
     * @covers ::getDescriptor
     * @covers ::setDescriptor
     */
    public function testPropertyDescriptor($value)
    {
        $object = new TableColumnSelector();
        $object->setDescriptor($value);

        $this->assertEquals($value, $object->getDescriptor());
    }

    /**
     * Data provider for property descriptor
     */
    public static function descriptorProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property odd
     * @test
     * @dataProvider oddProvider
     * @covers ::getOdd
     * @covers ::setOdd
     */
    public function testPropertyOdd($value)
    {
        $object = new TableColumnSelector();
        $object->setOdd($value);

        $this->assertEquals($value, $object->getOdd());
    }

    /**
     * Data provider for property odd
     */
    public static function oddProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property even
     * @test
     * @dataProvider evenProvider
     * @covers ::getEven
     * @covers ::setEven
     */
    public function testPropertyEven($value)
    {
        $object = new TableColumnSelector();
        $object->setEven($value);

        $this->assertEquals($value, $object->getEven());
    }

    /**
     * Data provider for property even
     */
    public static function evenProvider()
    {
        return [[true], [false]];
    }
}
