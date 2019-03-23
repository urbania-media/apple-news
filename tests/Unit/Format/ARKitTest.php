<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ARKit;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ARKit
 */
class ARKitTest extends TestCase
{
    /**
     * Test the property URL
     * @test
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testProperyURL()
    {
        $value = "a string";
        $object = new ARKit();
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
        $object = new ARKit();
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
        $object = new ARKit();
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
        $object = new ARKit();
        $object->setExplicitContent($value);

        $this->assertEquals($value, $object->getExplicitContent());
    }

    /**
     * Test the property role
     * @test
     * @covers ::getRole
     * @covers ::setRole
     */
    public function testProperyRole()
    {
        $value = "a string";
        $object = new ARKit();
        $object->setRole($value);

        $this->assertEquals($value, $object->getRole());
    }
}
