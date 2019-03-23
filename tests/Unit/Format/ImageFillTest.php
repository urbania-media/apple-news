<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ImageFill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ImageFill
 */
class ImageFillTest extends TestCase
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
        $object = new ImageFill();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Test the property fillMode
     * @test
     * @covers ::getFillMode
     * @covers ::setFillMode
     */
    public function testProperyFillMode()
    {
        $value = "fit";
        $object = new ImageFill();
        $object->setFillMode($value);

        $this->assertEquals($value, $object->getFillMode());
    }

    /**
     * Test the property horizontalAlignment
     * @test
     * @covers ::getHorizontalAlignment
     * @covers ::setHorizontalAlignment
     */
    public function testProperyHorizontalAlignment()
    {
        $value = "right";
        $object = new ImageFill();
        $object->setHorizontalAlignment($value);

        $this->assertEquals($value, $object->getHorizontalAlignment());
    }

    /**
     * Test the property type
     * @test
     * @covers ::getType
     */
    public function testProperyType()
    {
        $value = "image";
        $object = new ImageFill();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Test the property verticalAlignment
     * @test
     * @covers ::getVerticalAlignment
     * @covers ::setVerticalAlignment
     */
    public function testProperyVerticalAlignment()
    {
        $value = "top";
        $object = new ImageFill();
        $object->setVerticalAlignment($value);

        $this->assertEquals($value, $object->getVerticalAlignment());
    }
}
