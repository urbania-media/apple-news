<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\DataTableSorting;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\DataTableSorting
 */
class DataTableSortingTest extends TestCase
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
        $object = new DataTableSorting();
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
     * Test the property direction
     * @test
     * @dataProvider directionProvider
     * @covers ::getDirection
     * @covers ::setDirection
     */
    public function testPropertyDirection($value)
    {
        $object = new DataTableSorting();
        $object->setDirection($value);

        $this->assertEquals($value, $object->getDirection());
    }

    /**
     * Data provider for property direction
     */
    public static function directionProvider()
    {
        return [["ascending"], ["descending"]];
    }
}
