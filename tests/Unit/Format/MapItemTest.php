<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\MapItem;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\MapItem
 */
class MapItemTest extends TestCase
{
    /**
     * Test the property latitude
     * @test
     * @dataProvider latitudeProvider
     * @covers ::getLatitude
     * @covers ::setLatitude
     */
    public function testPropertyLatitude($value)
    {
        $object = new MapItem();
        $object->setLatitude($value);

        $this->assertEquals($value, $object->getLatitude());
    }

    /**
     * Data provider for property latitude
     */
    public function latitudeProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property longitude
     * @test
     * @dataProvider longitudeProvider
     * @covers ::getLongitude
     * @covers ::setLongitude
     */
    public function testPropertyLongitude($value)
    {
        $object = new MapItem();
        $object->setLongitude($value);

        $this->assertEquals($value, $object->getLongitude());
    }

    /**
     * Data provider for property longitude
     */
    public function longitudeProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property caption
     * @test
     * @dataProvider captionProvider
     * @covers ::getCaption
     * @covers ::setCaption
     */
    public function testPropertyCaption($value)
    {
        $object = new MapItem();
        $object->setCaption($value);

        $this->assertEquals($value, $object->getCaption());
    }

    /**
     * Data provider for property caption
     */
    public function captionProvider()
    {
        return [["a string"]];
    }
}
