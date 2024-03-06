<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TableRowStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TableRowStyle
 */
class TableRowStyleTest extends TestCase
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
        $object = new TableRowStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Data provider for property backgroundColor
     */
    public static function backgroundColorProvider()
    {
        return [['#fff'], ['#000']];
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
        $object = new TableRowStyle();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ConditionalTableRowStyle()]]];
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
        $object = new TableRowStyle();
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
     * Test the property height
     * @test
     * @dataProvider heightProvider
     * @covers ::getHeight
     * @covers ::setHeight
     */
    public function testPropertyHeight($value)
    {
        $object = new TableRowStyle();
        $object->setHeight($value);

        $this->assertEquals($value, $object->getHeight());
    }

    /**
     * Data provider for property height
     */
    public static function heightProvider()
    {
        return [['1vh'], [1], ['1vmin'], [1.1], [1]];
    }
}
