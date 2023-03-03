<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\GalleryItem;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\GalleryItem
 */
class GalleryItemTest extends TestCase
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
        $object = new GalleryItem();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public static function URLProvider()
    {
        return [["http://example.com"], ["https://example.com"]];
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
        $object = new GalleryItem();
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
     * Test the property caption
     * @test
     * @dataProvider captionProvider
     * @covers ::getCaption
     * @covers ::setCaption
     */
    public function testPropertyCaption($value)
    {
        $object = new GalleryItem();
        $object->setCaption($value);

        $this->assertEquals($value, $object->getCaption());
    }

    /**
     * Data provider for property caption
     */
    public static function captionProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\CaptionDescriptor()],
            ["a string"]
        ];
    }

    /**
     * Test the property explicitContent
     * @test
     * @dataProvider explicitContentProvider
     * @covers ::getExplicitContent
     * @covers ::setExplicitContent
     */
    public function testPropertyExplicitContent($value)
    {
        $object = new GalleryItem();
        $object->setExplicitContent($value);

        $this->assertEquals($value, $object->getExplicitContent());
    }

    /**
     * Data provider for property explicitContent
     */
    public static function explicitContentProvider()
    {
        return [[true], [false]];
    }
}
