<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableColumnStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableColumnStyle
 */
class TableColumnStyleTest extends TestCase
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
        $object = new TableColumnStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Data provider for property backgroundColor
     */
    public static function backgroundColorProvider()
    {
        return [["#fff"], ["#000"]];
    }

    /**
     * Test the property conditional
     * @test
     * @dataProvider conditionalProvider
     * @covers ::getConditional
     * @covers ::setConditional
     */
    public function testPropertyConditional($value)
    {
        $object = new TableColumnStyle();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [
            [[new \Urbania\AppleNews\Format\ConditionalTableColumnStyle()]]
        ];
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
        $object = new TableColumnStyle();
        $object->setDivider($value);

        $this->assertEquals($value, $object->getDivider());
    }

    /**
     * Data provider for property divider
     */
    public static function dividerProvider()
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
        $object = new TableColumnStyle();
        $object->setMinimumWidth($value);

        $this->assertEquals($value, $object->getMinimumWidth());
    }

    /**
     * Data provider for property minimumWidth
     */
    public static function minimumWidthProvider()
    {
        return [["1vh"], [1], ["1vmin"], [1]];
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
        $object = new TableColumnStyle();
        $object->setWidth($value);

        $this->assertEquals($value, $object->getWidth());
    }

    /**
     * Data provider for property width
     */
    public static function widthProvider()
    {
        return [[1]];
    }
}
