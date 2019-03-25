<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Place;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Place
 */
class PlaceTest extends TestCase
{
    /**
     * Test the property accessibilityCaption
     * @test
     * @dataProvider accessibilityCaptionProvider
     * @covers ::getAccessibilityCaption
     * @covers ::setAccessibilityCaption
     */
    public function testPropertyAccessibilityCaption($value)
    {
        $object = new Place();
        $object->setAccessibilityCaption($value);

        $this->assertEquals($value, $object->getAccessibilityCaption());
    }

    /**
     * Data provider for property accessibilityCaption
     */
    public function accessibilityCaptionProvider()
    {
        return [["a string"]];
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
        $object = new Place();
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

    /**
     * Test the property latitude
     * @test
     * @dataProvider latitudeProvider
     * @covers ::getLatitude
     * @covers ::setLatitude
     */
    public function testPropertyLatitude($value)
    {
        $object = new Place();
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
        $object = new Place();
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
     * Test the property mapType
     * @test
     * @dataProvider mapTypeProvider
     * @covers ::getMapType
     * @covers ::setMapType
     */
    public function testPropertyMapType($value)
    {
        $object = new Place();
        $object->setMapType($value);

        $this->assertEquals($value, $object->getMapType());
    }

    /**
     * Data provider for property mapType
     */
    public function mapTypeProvider()
    {
        return [["standard"], ["hybrid"], ["satellite"]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new Place();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["place"]];
    }

    /**
     * Test the property span
     * @test
     * @dataProvider spanProvider
     * @covers ::getSpan
     * @covers ::setSpan
     */
    public function testPropertySpan($value)
    {
        $object = new Place();
        $object->setSpan($value);

        $this->assertEquals($value, $object->getSpan());
    }

    /**
     * Data provider for property span
     */
    public function spanProvider()
    {
        return [[new \Urbania\AppleNews\Format\MapSpan()]];
    }
}
