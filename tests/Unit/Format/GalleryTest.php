<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Gallery;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Gallery
 */
class GalleryTest extends TestCase
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
        $object = new Gallery();
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
        $object = new Gallery();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["gallery"]];
    }
}
