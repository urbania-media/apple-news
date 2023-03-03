<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableRowSelector;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableRowSelector
 */
class TableRowSelectorTest extends TestCase
{
    /**
     * Test the property descriptor
     * @test
     * @dataProvider descriptorProvider
     * @covers ::getDescriptor
     * @covers ::setDescriptor
     */
    public function testPropertyDescriptor($value)
    {
        $object = new TableRowSelector();
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
     * Test the property rowIndex
     * @test
     * @dataProvider rowIndexProvider
     * @covers ::getRowIndex
     * @covers ::setRowIndex
     */
    public function testPropertyRowIndex($value)
    {
        $object = new TableRowSelector();
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

    /**
     * Test the property odd
     * @test
     * @dataProvider oddProvider
     * @covers ::getOdd
     * @covers ::setOdd
     */
    public function testPropertyOdd($value)
    {
        $object = new TableRowSelector();
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
        $object = new TableRowSelector();
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
