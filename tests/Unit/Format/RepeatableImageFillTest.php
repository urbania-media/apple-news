<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\RepeatableImageFill;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\RepeatableImageFill
 */
class RepeatableImageFillTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new RepeatableImageFill();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["repeatable_image"]];
    }

    /**
     * Test the property URL
     * @test
     * @dataProvider URLProvider
     * @covers ::getURL
     * @covers ::setURL
     */
    public function testPropertyURL($value)
    {
        $object = new RepeatableImageFill();
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
     * Test the property attachment
     * @test
     * @dataProvider attachmentProvider
     * @covers ::getAttachment
     * @covers ::setAttachment
     */
    public function testPropertyAttachment($value)
    {
        $object = new RepeatableImageFill();
        $object->setAttachment($value);

        $this->assertEquals($value, $object->getAttachment());
    }

    /**
     * Data provider for property attachment
     */
    public function attachmentProvider()
    {
        return [["fixed"], ["scroll"]];
    }

    /**
     * Test the property height
     * @test
     * @dataProvider heightProvider
     * @covers ::getHeight
     * @covers ::setHeight
     */
    public function testPropertyHeight($value)
    {
        $object = new RepeatableImageFill();
        $object->setHeight($value);

        $this->assertEquals($value, $object->getHeight());
    }

    /**
     * Data provider for property height
     */
    public function heightProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
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
        $object = new RepeatableImageFill();
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
     * Test the property repeat
     * @test
     * @dataProvider repeatProvider
     * @covers ::getRepeat
     * @covers ::setRepeat
     */
    public function testPropertyRepeat($value)
    {
        $object = new RepeatableImageFill();
        $object->setRepeat($value);

        $this->assertEquals($value, $object->getRepeat());
    }

    /**
     * Data provider for property repeat
     */
    public function repeatProvider()
    {
        return [["none"], ["x"], ["y"], ["both"]];
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
        $object = new RepeatableImageFill();
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

    /**
     * Test the property width
     * @test
     * @dataProvider widthProvider
     * @covers ::getWidth
     * @covers ::setWidth
     */
    public function testPropertyWidth($value)
    {
        $object = new RepeatableImageFill();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public function widthProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }
}
