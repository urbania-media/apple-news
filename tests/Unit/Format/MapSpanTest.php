<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\MapSpan;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\MapSpan
 */
class MapSpanTest extends TestCase
{
    /**
     * Test the property latitudeDelta
     * @test
     * @dataProvider latitudeDeltaProvider
     * @covers ::getLatitudeDelta
     * @covers ::setLatitudeDelta
     */
    public function testPropertyLatitudeDelta($value)
    {
        $object = new MapSpan();
        $object->setLatitudeDelta($value);

        $this->assertEquals($value, $object->getLatitudeDelta());
    }

    /**
     * Data provider for property latitudeDelta
     */
    public function latitudeDeltaProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property longitudeDelta
     * @test
     * @dataProvider longitudeDeltaProvider
     * @covers ::getLongitudeDelta
     * @covers ::setLongitudeDelta
     */
    public function testPropertyLongitudeDelta($value)
    {
        $object = new MapSpan();
        $object->setLongitudeDelta($value);

        $this->assertEquals($value, $object->getLongitudeDelta());
    }

    /**
     * Data provider for property longitudeDelta
     */
    public function longitudeDeltaProvider()
    {
        return [[1.1], [1]];
    }
}
