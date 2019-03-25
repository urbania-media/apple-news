<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalTableRowStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalTableRowStyle
 */
class ConditionalTableRowStyleTest extends TestCase
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
        $object = new ConditionalTableRowStyle();
        $object->setSelectors($value);

        $this->assertEquals($value, $object->getSelectors());
    }

    /**
     * Data provider for property selectors
     */
    public function selectorsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\TableRowSelector()]]];
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
        $object = new ConditionalTableRowStyle();
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
        $object = new ConditionalTableRowStyle();
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
     * Test the property height
     * @test
     * @dataProvider heightProvider
     * @covers ::getHeight
     * @covers ::setHeight
     */
    public function testPropertyHeight($value)
    {
        $object = new ConditionalTableRowStyle();
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
}
