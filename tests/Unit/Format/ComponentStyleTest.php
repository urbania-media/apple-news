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
     * Test the property conditional
     * @test
     * @dataProvider conditionalProvider
     * @covers ::getConditional
     * @covers ::setConditional
     */
    public function testPropertyConditional($value)
    {
        $object = new ComponentStyle();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ConditionalComponentStyle()],
            [[new \Urbania\AppleNews\Format\ConditionalComponentStyle()]],
        ];
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
        $object = new ComponentStyle();
        $object->setBackgroundColor($value);

        $this->assertEquals($value, $object->getBackgroundColor());
    }

    /**
     * Data provider for property backgroundColor
     */
    public static function backgroundColorProvider()
    {
        return [['#fff'], ['#000'], ['none']];
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
    public static function borderProvider()
    {
        return [[new \Urbania\AppleNews\Format\Border()], ['none']];
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
    public static function fillProvider()
    {
        return [[new \Urbania\AppleNews\Format\Fill()], ['none']];
    }

    /**
     * Test the property mask
     * @test
     * @dataProvider maskProvider
     * @covers ::getMask
     * @covers ::setMask
     */
    public function testPropertyMask($value)
    {
        $object = new ComponentStyle();
        $object->setMask($value);

        $this->assertEquals($value, $object->getMask());
    }

    /**
     * Data provider for property mask
     */
    public static function maskProvider()
    {
        return [[new \Urbania\AppleNews\Format\CornerMask()], ['none']];
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
    public static function opacityProvider()
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
    public static function tableStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\TableStyle()], ['none']];
    }

    /**
     * Test the property shadow
     * @test
     * @dataProvider shadowProvider
     * @covers ::getShadow
     * @covers ::setShadow
     */
    public function testPropertyShadow($value)
    {
        $object = new ComponentStyle();
        $object->setShadow($value);

        $this->assertEquals($value, $object->getShadow());
    }

    /**
     * Data provider for property shadow
     */
    public static function shadowProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentShadow()]];
    }
}
