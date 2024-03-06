<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableCellSelector;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableCellSelector
 */
class TableCellSelectorTest extends TestCase
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
        $object = new TableCellSelector();
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
        $object = new TableCellSelector();
        $object->setDescriptor($value);

        $this->assertEquals($value, $object->getDescriptor());
    }

    /**
     * Data provider for property descriptor
     */
    public static function descriptorProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property evenColumns
     * @test
     * @dataProvider evenColumnsProvider
     * @covers ::getEvenColumns
     * @covers ::setEvenColumns
     */
    public function testPropertyEvenColumns($value)
    {
        $object = new TableCellSelector();
        $object->setEvenColumns($value);

        $this->assertEquals($value, $object->getEvenColumns());
    }

    /**
     * Data provider for property evenColumns
     */
    public static function evenColumnsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property evenRows
     * @test
     * @dataProvider evenRowsProvider
     * @covers ::getEvenRows
     * @covers ::setEvenRows
     */
    public function testPropertyEvenRows($value)
    {
        $object = new TableCellSelector();
        $object->setEvenRows($value);

        $this->assertEquals($value, $object->getEvenRows());
    }

    /**
     * Data provider for property evenRows
     */
    public static function evenRowsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property oddColumns
     * @test
     * @dataProvider oddColumnsProvider
     * @covers ::getOddColumns
     * @covers ::setOddColumns
     */
    public function testPropertyOddColumns($value)
    {
        $object = new TableCellSelector();
        $object->setOddColumns($value);

        $this->assertEquals($value, $object->getOddColumns());
    }

    /**
     * Data provider for property oddColumns
     */
    public static function oddColumnsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property oddRows
     * @test
     * @dataProvider oddRowsProvider
     * @covers ::getOddRows
     * @covers ::setOddRows
     */
    public function testPropertyOddRows($value)
    {
        $object = new TableCellSelector();
        $object->setOddRows($value);

        $this->assertEquals($value, $object->getOddRows());
    }

    /**
     * Data provider for property oddRows
     */
    public static function oddRowsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property rowIndex
     * @test
     * @dataProvider rowIndexProvider
     * @covers ::getRowIndex
     * @covers ::setRowIndex
     */
    public function testPropertyRowIndex($value)
    {
        $object = new TableCellSelector();
        $object->setRowIndex($value);

        $this->assertEquals($value, $object->getRowIndex());
    }

    /**
     * Data provider for property rowIndex
     */
    public static function rowIndexProvider()
    {
        return [[1]];
    }
}
