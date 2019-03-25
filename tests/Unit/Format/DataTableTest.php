<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\DataTable;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\DataTable
 */
class DataTableTest extends TestCase
{
    /**
     * Test the property data
     * @test
     * @dataProvider dataProvider
     * @covers ::getData
     * @covers ::setData
     */
    public function testPropertyData($value)
    {
        $object = new DataTable();
        $object->setData($value);

        $this->assertEquals($value, $object->getData());
    }

    /**
     * Data provider for property data
     */
    public function dataProvider()
    {
        return [[new \Urbania\AppleNews\Format\RecordStore()]];
    }

    /**
     * Test the property dataOrientation
     * @test
     * @dataProvider dataOrientationProvider
     * @covers ::getDataOrientation
     * @covers ::setDataOrientation
     */
    public function testPropertyDataOrientation($value)
    {
        $object = new DataTable();
        $object->setDataOrientation($value);

        $this->assertEquals($value, $object->getDataOrientation());
    }

    /**
     * Data provider for property dataOrientation
     */
    public function dataOrientationProvider()
    {
        return [["horizontal"], ["vertical"]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new DataTable();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["datatable"]];
    }

    /**
     * Test the property showDescriptorLabels
     * @test
     * @dataProvider showDescriptorLabelsProvider
     * @covers ::getShowDescriptorLabels
     * @covers ::setShowDescriptorLabels
     */
    public function testPropertyShowDescriptorLabels($value)
    {
        $object = new DataTable();
        $object->setShowDescriptorLabels($value);

        $this->assertEquals($value, $object->getShowDescriptorLabels());
    }

    /**
     * Data provider for property showDescriptorLabels
     */
    public function showDescriptorLabelsProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property sortBy
     * @test
     * @dataProvider sortByProvider
     * @covers ::getSortBy
     * @covers ::setSortBy
     */
    public function testPropertySortBy($value)
    {
        $object = new DataTable();
        $object->setSortBy($value);

        $this->assertEquals($value, $object->getSortBy());
    }

    /**
     * Data provider for property sortBy
     */
    public function sortByProvider()
    {
        return [[[new \Urbania\AppleNews\Format\DataTableSorting()]]];
    }

    /**
     * Test the property style
     * @test
     * @dataProvider styleProvider
     * @covers ::getStyle
     * @covers ::setStyle
     */
    public function testPropertyStyle($value)
    {
        $object = new DataTable();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public function styleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyle()]];
    }
}
