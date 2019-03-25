<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ComponentStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ComponentStyle
 */
class ComponentStyleTest extends TestCase
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
        $object = new ComponentStyle();
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
        $object = new ComponentStyle();
        $object->setBorder($value);

        $this->assertEquals($value, $object->getBorder());
    }

    /**
     * Data provider for property border
     */
    public function borderProvider()
    {
        return [[new \Urbania\AppleNews\Format\Border()]];
    }

    /**
     * Test the property fill
     * @test
     * @dataProvider fillProvider
     * @covers ::getFill
     * @covers ::setFill
     */
    public function testPropertyFill($value)
    {
        $object = new ComponentStyle();
        $object->setFill($value);

        $this->assertEquals($value, $object->getFill());
    }

    /**
     * Data provider for property fill
     */
    public function fillProvider()
    {
        return [[new \Urbania\AppleNews\Format\Fill()]];
    }

    /**
     * Test the property opacity
     * @test
     * @dataProvider opacityProvider
     * @covers ::getOpacity
     * @covers ::setOpacity
     */
    public function testPropertyOpacity($value)
    {
        $object = new ComponentStyle();
        $object->setOpacity($value);

        $this->assertEquals($value, $object->getOpacity());
    }

    /**
     * Data provider for property opacity
     */
    public function opacityProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property tableStyle
     * @test
     * @dataProvider tableStyleProvider
     * @covers ::getTableStyle
     * @covers ::setTableStyle
     */
    public function testPropertyTableStyle($value)
    {
        $object = new ComponentStyle();
        $object->setTableStyle($value);

        $this->assertEquals($value, $object->getTableStyle());
    }

    /**
     * Data provider for property tableStyle
     */
    public function tableStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableStyle()]];
    }
}
