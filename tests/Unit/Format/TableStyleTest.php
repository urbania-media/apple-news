<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableStyle
 */
class TableStyleTest extends TestCase
{
    /**
     * Test the property cells
     * @test
     * @dataProvider cellsProvider
     * @covers ::getCells
     * @covers ::setCells
     */
    public function testPropertyCells($value)
    {
        $object = new TableStyle();
        $object->setCells($value);

        $this->assertEquals($value, $object->getCells());
    }

    /**
     * Data provider for property cells
     */
    public function cellsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableCellStyle()]];
    }

    /**
     * Test the property columns
     * @test
     * @dataProvider columnsProvider
     * @covers ::getColumns
     * @covers ::setColumns
     */
    public function testPropertyColumns($value)
    {
        $object = new TableStyle();
        $object->setColumns($value);

        $this->assertEquals($value, $object->getColumns());
    }

    /**
     * Data provider for property columns
     */
    public function columnsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableColumnStyle()]];
    }

    /**
     * Test the property headerCells
     * @test
     * @dataProvider headerCellsProvider
     * @covers ::getHeaderCells
     * @covers ::setHeaderCells
     */
    public function testPropertyHeaderCells($value)
    {
        $object = new TableStyle();
        $object->setHeaderCells($value);

        $this->assertEquals($value, $object->getHeaderCells());
    }

    /**
     * Data provider for property headerCells
     */
    public function headerCellsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableCellStyle()]];
    }

    /**
     * Test the property headerColumns
     * @test
     * @dataProvider headerColumnsProvider
     * @covers ::getHeaderColumns
     * @covers ::setHeaderColumns
     */
    public function testPropertyHeaderColumns($value)
    {
        $object = new TableStyle();
        $object->setHeaderColumns($value);

        $this->assertEquals($value, $object->getHeaderColumns());
    }

    /**
     * Data provider for property headerColumns
     */
    public function headerColumnsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableColumnStyle()]];
    }

    /**
     * Test the property headerRows
     * @test
     * @dataProvider headerRowsProvider
     * @covers ::getHeaderRows
     * @covers ::setHeaderRows
     */
    public function testPropertyHeaderRows($value)
    {
        $object = new TableStyle();
        $object->setHeaderRows($value);

        $this->assertEquals($value, $object->getHeaderRows());
    }

    /**
     * Data provider for property headerRows
     */
    public function headerRowsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableRowStyle()]];
    }

    /**
     * Test the property rows
     * @test
     * @dataProvider rowsProvider
     * @covers ::getRows
     * @covers ::setRows
     */
    public function testPropertyRows($value)
    {
        $object = new TableStyle();
        $object->setRows($value);

        $this->assertEquals($value, $object->getRows());
    }

    /**
     * Data provider for property rows
     */
    public function rowsProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableRowStyle()]];
    }
}
