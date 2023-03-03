<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\CoverArt;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\CoverArt
 */
class CoverArtTest extends TestCase
{
    /**
     * Test the property URL
     * @test
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new CoverArt();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public static function URLProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property accessibilityCaption
     * @test
     * @dataProvider accessibilityCaptionProvider
     * @covers ::getAccessibilityCaption
     * @covers ::setAccessibilityCaption
     */
    public function testPropertyAccessibilityCaption($value)
    {
        $object = new CoverArt();
        $object->setAccessibilityCaption($value);

        $this->assertEquals($value, $object->getAccessibilityCaption());
    }

    /**
     * Data provider for property accessibilityCaption
     */
    public static function accessibilityCaptionProvider()
    {
        return [["a string"]];
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
        $object = new CoverArt();
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
}
