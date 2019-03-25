<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\EmbedWebVideo;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\EmbedWebVideo
 */
class EmbedWebVideoTest extends TestCase
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
        $object = new EmbedWebVideo();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public function URLProvider()
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
        $object = new EmbedWebVideo();
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
     * Test the property aspectRatio
     * @test
     * @dataProvider aspectRatioProvider
     * @covers ::getAspectRatio
     * @covers ::setAspectRatio
     */
    public function testPropertyAspectRatio($value)
    {
        $object = new EmbedWebVideo();
        $object->setAspectRatio($value);

        $this->assertEquals($value, $object->getAspectRatio());
    }

    /**
     * Data provider for property aspectRatio
     */
    public function aspectRatioProvider()
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
        $object = new EmbedWebVideo();
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
     * Test the property explicitContent
     * @test
     * @dataProvider explicitContentProvider
     * @covers ::getExplicitContent
     * @covers ::setExplicitContent
     */
    public function testPropertyExplicitContent($value)
    {
        $object = new EmbedWebVideo();
        $object->setExplicitContent($value);

        $this->assertEquals($value, $object->getExplicitContent());
    }

    /**
     * Data provider for property explicitContent
     */
    public function explicitContentProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     */
    public function testPropertyRole($value)
    {
        $object = new EmbedWebVideo();

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["embedwebvideo"]];
    }
}
