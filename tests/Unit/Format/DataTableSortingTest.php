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
     * @covers ::getDescriptor
     * @covers ::setDescriptor
     */
    public function testProperyDescriptor()
    {
        $value = "a string";
        $object = new DataTableSorting();
        $object->setDescriptor($value);

        $this->assertEquals($value, $object->getDescriptor());
    }

    /**
     * Test the property direction
     * @test
     * @covers ::getDirection
     * @covers ::setDirection
     */
    public function testProperyDirection()
    {
        $value = "ascending";
        $object = new DataTableSorting();
        $object->setDirection($value);

        $this->assertEquals($value, $object->getDirection());
    }
}
