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
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new ImageFill();
        $object->setURL($value);

        $this->assertEquals($value, $object->getURL());
    }

    /**
     * Data provider for property URL
     */
    public function URLProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property fillMode
     * @test
     * @dataProvider fillModeProvider
     * @covers ::getFillMode
     * @covers ::setFillMode
     */
    public function testPropertyFillMode($value)
    {
        $object = new ImageFill();
        $object->setFillMode($value);

        $this->assertEquals($value, $object->getFillMode());
    }

    /**
     * Data provider for property fillMode
     */
    public function fillModeProvider()
    {
        return [["fit"], ["cover"]];
    }

    /**
     * Test the property horizontalAlignment
     * @test
     * @dataProvider horizontalAlignmentProvider
     * @covers ::getHorizontalAlignment
     * @covers ::setHorizontalAlignment
     */
    public function testPropertyHorizontalAlignment($value)
    {
        $object = new ImageFill();
        $object->setHorizontalAlignment($value);

        $this->assertEquals($value, $object->getHorizontalAlignment());
    }

    /**
     * Data provider for property horizontalAlignment
     */
    public function horizontalAlignmentProvider()
    {
        return [["left"], ["center"], ["right"]];
    }

    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new ImageFill();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["image"]];
    }

    /**
     * Test the property verticalAlignment
     * @test
     * @dataProvider verticalAlignmentProvider
     * @covers ::getVerticalAlignment
     * @covers ::setVerticalAlignment
     */
    public function testPropertyVerticalAlignment($value)
    {
        $object = new ImageFill();
        $object->setVerticalAlignment($value);

        $this->assertEquals($value, $object->getVerticalAlignment());
    }

    /**
     * Data provider for property verticalAlignment
     */
    public function verticalAlignmentProvider()
    {
        return [["top"], ["center"], ["bottom"]];
    }
}
