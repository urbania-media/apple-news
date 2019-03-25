<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Mosaic;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Mosaic
 */
class MosaicTest extends TestCase
{
    /**
     * Test the property items
     * @test
     * @dataProvider itemsProvider
     * @covers ::getItems
     * @covers ::setItems
     */
    public function testPropertyItems($value)
    {
        $object = new Mosaic();
        $object->setItems($value);

        $this->assertEquals($value, $object->getItems());
    }

    /**
     * Data provider for property items
     */
    public function itemsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\GalleryItem()]]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Mosaic();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["mosaic"]];
    }
}
