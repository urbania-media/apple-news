<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalTableColumnStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalTableColumnStyle
 */
class ConditionalTableColumnStyleTest extends TestCase
{
    /**
     * Test the property backgroundColor
     * @test
     * @dataProvider backgroundColorProvider
     * @covers ::getBackgroundColor
     * @covers ::setBackgroundColor
     */
    public function testPropertyBackgroundColor($value)
    {
        $object = new ConditionalTableColumnStyle();
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
     * Test the property divider
     * @test
     * @dataProvider dividerProvider
     * @covers ::getDivider
     * @covers ::setDivider
     */
    public function testPropertyDivider($value)
    {
        $object = new ConditionalTableColumnStyle();
        $object->setDivider($value);

        $this->assertEquals($value, $object->getDivider());
    }

    /**
     * Data provider for property divider
     */
    public function dividerProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableStrokeStyle()]];
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
        $object = new ConditionalTableColumnStyle();
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
     * Test the property selectors
     * @test
     * @dataProvider selectorsProvider
     * @covers ::getSelectors
     * @covers ::setSelectors
     */
    public function testPropertySelectors($value)
    {
        $object = new ConditionalTableColumnStyle();
        $object->setSelectors($value);

        $this->assertEquals($value, $object->getSelectors());
    }

    /**
     * Data provider for property selectors
     */
    public function selectorsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\TableColumnSelector()]]];
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
        $object = new ConditionalTableColumnStyle();
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
