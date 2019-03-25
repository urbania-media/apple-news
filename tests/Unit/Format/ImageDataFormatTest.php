<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ImageDataFormat;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ImageDataFormat
 */
class ImageDataFormatTest extends TestCase
{
    /**
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new ImageDataFormat();

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
     * Test the property maximumHeight
     * @test
     * @dataProvider maximumHeightProvider
     * @covers ::getMaximumHeight
     * @covers ::setMaximumHeight
     */
    public function testPropertyMaximumHeight($value)
    {
        $object = new ImageDataFormat();
        $object->setMaximumHeight($value);

        $this->assertEquals($value, $object->getMaximumHeight());
    }

    /**
     * Data provider for property maximumHeight
     */
    public function maximumHeightProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }

    /**
     * Test the property maximumWidth
     * @test
     * @dataProvider maximumWidthProvider
     * @covers ::getMaximumWidth
     * @covers ::setMaximumWidth
     */
    public function testPropertyMaximumWidth($value)
    {
        $object = new ImageDataFormat();
        $object->setMaximumWidth($value);

        $this->assertEquals($value, $object->getMaximumWidth());
    }

    /**
     * Data provider for property maximumWidth
     */
    public function maximumWidthProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }

    /**
     * Test the property minimumHeight
     * @test
     * @dataProvider minimumHeightProvider
     * @covers ::getMinimumHeight
     * @covers ::setMinimumHeight
     */
    public function testPropertyMinimumHeight($value)
    {
        $object = new ImageDataFormat();
        $object->setMinimumHeight($value);

        $this->assertEquals($value, $object->getMinimumHeight());
    }

    /**
     * Data provider for property minimumHeight
     */
    public function minimumHeightProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }

    /**
     * Test the property minimumWidth
     * @test
     * @dataProvider minimumWidthProvider
     * @covers ::getMinimumWidth
     * @covers ::setMinimumWidth
     */
    public function testPropertyMinimumWidth($value)
    {
        $object = new ImageDataFormat();
        $object->setMinimumWidth($value);

        $this->assertEquals($value, $object->getMinimumWidth());
    }

    /**
     * Data provider for property minimumWidth
     */
    public function minimumWidthProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
    }
}
