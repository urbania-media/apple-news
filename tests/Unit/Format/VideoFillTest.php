<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\VideoFill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\VideoFill
 */
class VideoFillTest extends TestCase
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
        $object = new VideoFill();
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
     * Test the property fillMode
     * @test
     * @dataProvider fillModeProvider
     * @covers ::getFillMode
     * @covers ::setFillMode
     */
    public function testPropertyFillMode($value)
    {
        $object = new VideoFill();
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
        $object = new VideoFill();
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
     * Test the property loop
     * @test
     * @dataProvider loopProvider
     * @covers ::getLoop
     * @covers ::setLoop
     */
    public function testPropertyLoop($value)
    {
        $object = new VideoFill();
        $object->setLoop($value);

        $this->assertEquals($value, $object->getLoop());
    }

    /**
     * Data provider for property loop
     */
    public function loopProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property stillURL
     * @test
     * @dataProvider stillURLProvider
     * @covers ::getStillURL
     * @covers ::setStillURL
     */
    public function testPropertyStillURL($value)
    {
        $object = new VideoFill();
        $object->setStillURL($value);

        $this->assertEquals($value, $object->getStillURL());
    }

    /**
     * Data provider for property stillURL
     */
    public function stillURLProvider()
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
        $object = new VideoFill();
        $object->setType($value);

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["a string"]];
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
        $object = new VideoFill();
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
