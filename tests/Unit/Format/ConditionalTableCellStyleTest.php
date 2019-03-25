<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalTableCellStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalTableCellStyle
 */
class ConditionalTableCellStyleTest extends TestCase
{
    /**
     * Test the property selectors
     * @test
     * @dataProvider selectorsProvider
     * @covers ::getSelectors
     * @covers ::setSelectors
     */
    public function testPropertySelectors($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setSelectors($value);

        $this->assertEquals($value, $object->getSelectors());
    }

    /**
     * Data provider for property selectors
     */
    public function selectorsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\TableCellSelector()]]];
    }

    /**
     * Test the property backgroundColor
     * @test
     * @dataProvider backgroundColorProvider
     * @covers ::getBackgroundColor
     * @covers ::setBackgroundColor
     */
    public function testPropertyBackgroundColor($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Data provider for property backgroundColor
     */
    public function backgroundColorProvider()
    {
        return [["#fff"], ["#000"]];
    }

    /**
     * Test the property border
     * @test
     * @dataProvider borderProvider
     * @covers ::getBorder
     * @covers ::setBorder
     */
    public function testPropertyBorder($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setBorder($value);

        $this->assertEquals($value, $object->getBorder());
    }

    /**
     * Data provider for property border
     */
    public function borderProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableBorder()]];
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
        $object = new ConditionalTableCellStyle();
        $object->setHeight($value);

        $this->assertEquals($value, $object->getHeight());
    }

    /**
     * Data provider for property height
     */
    public function heightProvider()
    {
        return [["1vh"], [1], ["1vmin"]];
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
        $object = new ConditionalTableCellStyle();
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
     * Test the property minimumWidth
     * @test
     * @dataProvider minimumWidthProvider
     * @covers ::getMinimumWidth
     * @covers ::setMinimumWidth
     */
    public function testPropertyMinimumWidth($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setMinimumWidth($value);

        $this->assertEquals($value, $object->getMinimumWidth());
    }

    /**
     * Data provider for property minimumWidth
     */
    public function minimumWidthProvider()
    {
        return [["1vh"], [1], ["1vmin"]];
    }

    /**
     * Test the property padding
     * @test
     * @dataProvider paddingProvider
     * @covers ::getPadding
     * @covers ::setPadding
     */
    public function testPropertyPadding($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setPadding($value);

        $this->assertEquals($value, $object->getPadding());
    }

    /**
     * Data provider for property padding
     */
    public function paddingProvider()
    {
        return [[new \Urbania\AppleNews\Format\Padding()]];
    }

    /**
     * Test the property textStyle
     * @test
     * @dataProvider textStyleProvider
     * @covers ::getTextStyle
     * @covers ::setTextStyle
     */
    public function testPropertyTextStyle($value)
    {
        $object = new ConditionalTableCellStyle();
        $object->setTextStyle($value);

        $this->assertEquals($value, $object->getTextStyle());
    }

    /**
     * Data provider for property textStyle
     */
    public function textStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentTextStyle()]];
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
        $object = new ConditionalTableCellStyle();
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
        $object = new ConditionalTableCellStyle();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public function widthProvider()
    {
        return [[1]];
    }
}
