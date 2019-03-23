<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableCellStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableCellStyle
 */
class TableCellStyleTest extends TestCase
{
    /**
     * Test the property backgroundColor
     * @test
     * @covers ::getBackgroundColor
     * @covers ::setBackgroundColor
     */
    public function testProperyBackgroundColor()
    {
        $value = "#fff";
        $object = new TableCellStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Test the property border
     * @test
     * @covers ::getBorder
     * @covers ::setBorder
     */
    public function testProperyBorder()
    {
        $value = new \Urbania\AppleNews\Format\TableBorder();
        $object = new TableCellStyle();
        $object->setBorder($value);

        $this->assertEquals($value, $object->getBorder());
    }

    /**
     * Test the property conditional
     * @test
     * @covers ::getConditional
     * @covers ::setConditional
     */
    public function testProperyConditional()
    {
        $value = [];
        $object = new TableCellStyle();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Test the property height
     * @test
     * @covers ::getHeight
     * @covers ::setHeight
     */
    public function testProperyHeight()
    {
        $value = "1vh";
        $object = new TableCellStyle();
        $object->setHeight($value);

        $this->assertEquals($value, $object->getHeight());
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
        $object = new TableCellStyle();
        $object->setHorizontalAlignment($value);

        $this->assertEquals($value, $object->getHorizontalAlignment());
    }

    /**
     * Test the property minimumWidth
     * @test
     * @covers ::getMinimumWidth
     * @covers ::setMinimumWidth
     */
    public function testProperyMinimumWidth()
    {
        $value = "1vh";
        $object = new TableCellStyle();
        $object->setMinimumWidth($value);

        $this->assertEquals($value, $object->getMinimumWidth());
    }

    /**
     * Test the property padding
     * @test
     * @covers ::getPadding
     * @covers ::setPadding
     */
    public function testProperyPadding()
    {
        $value = new \Urbania\AppleNews\Format\Padding();
        $object = new TableCellStyle();
        $object->setPadding($value);

        $this->assertEquals($value, $object->getPadding());
    }

    /**
     * Test the property textStyle
     * @test
     * @covers ::getTextStyle
     * @covers ::setTextStyle
     */
    public function testProperyTextStyle()
    {
        $value = new \Urbania\AppleNews\Format\ComponentTextStyle();
        $object = new TableCellStyle();
        $object->setTextStyle($value);

        $this->assertEquals($value, $object->getTextStyle());
    }

    /**
     * Test the property verticalAlignment
     * @test
     * @covers ::getVerticalAlignment
     * @covers ::setVerticalAlignment
     */
    public function testProperyVerticalAlignment()
    {
        $value = "bottom";
        $object = new TableCellStyle();
        $object->setVerticalAlignment($value);

        $this->assertEquals($value, $object->getVerticalAlignment());
    }

    /**
     * Test the property width
     * @test
     * @covers ::getWidth
     * @covers ::setWidth
     */
    public function testProperyWidth()
    {
        $value = 1;
        $object = new TableCellStyle();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }
}
