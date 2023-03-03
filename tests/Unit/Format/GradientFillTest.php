<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\GradientFill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\GradientFill
 */
class GradientFillTest extends TestCase
{
    /**
     * Test the property colorStops
     * @test
     * @dataProvider colorStopsProvider
     * @covers ::getColorStops
     * @covers ::setColorStops
     */
    public function testPropertyColorStops($value)
    {
        $object = new GradientFill();
        $object->setColorStops($value);

        $this->assertEquals($value, $object->getColorStops());
    }

    /**
     * Data provider for property colorStops
     */
    public static function colorStopsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ColorStop()]]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     * @covers ::setType
     */
    public function testPropertyType($value)
    {
        $object = new GradientFill();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public static function typeProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property attachment
     * @test
     * @dataProvider attachmentProvider
     * @covers ::getAttachment
     * @covers ::setAttachment
     */
    public function testPropertyAttachment($value)
    {
        $object = new GradientFill();
        $object->setAttachment($value);

        $this->assertEquals($value, $object->getAttachment());
    }

    /**
     * Data provider for property attachment
     */
    public static function attachmentProvider()
    {
        return [["fixed"], ["scroll"]];
    }
}
