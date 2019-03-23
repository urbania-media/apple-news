<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Music;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Music
 */
class MusicTest extends TestCase
{
    /**
     * Test the property URL
     * @test
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testProperyURL()
    {
        $value = "http://example.com";
        $object = new Music();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Test the property accessibilityCaption
     * @test
     * @covers ::getAccessibilityCaption
     * @covers ::setAccessibilityCaption
     */
    public function testProperyAccessibilityCaption()
    {
        $value = "a string";
        $object = new Music();
        $object->setAccessibilityCaption($value);

        $this->assertEquals($value, $object->getAccessibilityCaption());
    }

    /**
     * Test the property caption
     * @test
     * @covers ::getCaption
     * @covers ::setCaption
     */
    public function testProperyCaption()
    {
        $value = "a string";
        $object = new Music();
        $object->setCaption($value);

        $this->assertEquals($value, $object->getCaption());
    }

    /**
     * Test the property explicitContent
     * @test
     * @covers ::getExplicitContent
     * @covers ::setExplicitContent
     */
    public function testProperyExplicitContent()
    {
        $value = null;
        $object = new Music();
        $object->setExplicitContent($value);

        $this->assertEquals($value, $object->getExplicitContent());
    }

    /**
     * Test the property imageURL
     * @test
     * @covers ::getImageURL
     * @covers ::setImageURL
     */
    public function testProperyImageURL()
    {
        $value = "a string";
        $object = new Music();
        $object->setImageURL($value);

        $this->assertEquals($value, $object->getImageURL());
    }

    /**
     * Test the property role
     * @test
     * @covers ::getRole
     */
    public function testProperyRole()
    {
        $value = "music";
        $object = new Music();

        $this->assertEquals($value, $object->getRole());
    }
}
