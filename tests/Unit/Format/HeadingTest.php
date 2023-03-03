<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Heading;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Heading
 */
class HeadingTest extends TestCase
{
    /**
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     * @covers ::setRole
     */
    public function testPropertyRole($value)
    {
        $object = new Heading();
        $object->setRole($value);

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public static function roleProvider()
    {
        return [
            ["heading"],
            ["heading1"],
            ["heading2"],
            ["heading3"],
            ["heading4"],
            ["heading5"],
            ["heading6"]
        ];
    }

    /**
     * Test the property text
     * @test
     * @dataProvider textProvider
     * @covers ::getText
     * @covers ::setText
     */
    public function testPropertyText($value)
    {
        $object = new Heading();
        $object->setText($value);

        $this->assertEquals($value, $object->getText());
    }

    /**
     * Data provider for property text
     */
    public static function textProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property additions
     * @test
     * @dataProvider additionsProvider
     * @covers ::getAdditions
     * @covers ::setAdditions
     */
    public function testPropertyAdditions($value)
    {
        $object = new Heading();
        $object->setAdditions($value);

        $this->assertEquals($value, $object->getAdditions());
    }

    /**
     * Data provider for property additions
     */
    public static function additionsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Addition()]]];
    }

    /**
     * Test the property anchor
     * @test
     * @dataProvider anchorProvider
     * @covers ::getAnchor
     * @covers ::setAnchor
     */
    public function testPropertyAnchor($value)
    {
        $object = new Heading();
        $object->setAnchor($value);

        $this->assertEquals($value, $object->getAnchor());
    }

    /**
     * Data provider for property anchor
     */
    public static function anchorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Anchor()]];
    }

    /**
     * Test the property animation
     * @test
     * @dataProvider animationProvider
     * @covers ::getAnimation
     * @covers ::setAnimation
     */
    public function testPropertyAnimation($value)
    {
        $object = new Heading();
        $object->setAnimation($value);

        $this->assertEquals($value, $object->getAnimation());
    }

    /**
     * Data provider for property animation
     */
    public static function animationProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentAnimation()]];
    }

    /**
     * Test the property behavior
     * @test
     * @dataProvider behaviorProvider
     * @covers ::getBehavior
     * @covers ::setBehavior
     */
    public function testPropertyBehavior($value)
    {
        $object = new Heading();
        $object->setBehavior($value);

        $this->assertEquals($value, $object->getBehavior());
    }

    /**
     * Data provider for property behavior
     */
    public static function behaviorProvider()
    {
        return [[new \Urbania\AppleNews\Format\Behavior()]];
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
        $object = new Heading();
        $object->setConditional($value);

        $this->assertEquals($value, $object->getConditional());
    }

    /**
     * Data provider for property conditional
     */
    public static function conditionalProvider()
    {
        return [[[new \Urbania\AppleNews\Format\ConditionalText()]]];
    }

    /**
     * Test the property format
     * @test
     * @dataProvider formatProvider
     * @covers ::getFormat
     * @covers ::setFormat
     */
    public function testPropertyFormat($value)
    {
        $object = new Heading();
        $object->setFormat($value);

        $this->assertEquals($value, $object->getFormat());
    }

    /**
     * Data provider for property format
     */
    public static function formatProvider()
    {
        return [["markdown"], ["html"], ["none"]];
    }

    /**
     * Test the property hidden
     * @test
     * @dataProvider hiddenProvider
     * @covers ::getHidden
     * @covers ::setHidden
     */
    public function testPropertyHidden($value)
    {
        $object = new Heading();
        $object->setHidden($value);

        $this->assertEquals($value, $object->getHidden());
    }

    /**
     * Data provider for property hidden
     */
    public static function hiddenProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property identifier
     * @test
     * @dataProvider identifierProvider
     * @covers ::getIdentifier
     * @covers ::setIdentifier
     */
    public function testPropertyIdentifier($value)
    {
        $object = new Heading();
        $object->setIdentifier($value);

        $this->assertEquals($value, $object->getIdentifier());
    }

    /**
     * Data provider for property identifier
     */
    public static function identifierProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property inlineTextStyles
     * @test
     * @dataProvider inlineTextStylesProvider
     * @covers ::getInlineTextStyles
     * @covers ::setInlineTextStyles
     */
    public function testPropertyInlineTextStyles($value)
    {
        $object = new Heading();
        $object->setInlineTextStyles($value);

        $this->assertEquals($value, $object->getInlineTextStyles());
    }

    /**
     * Data provider for property inlineTextStyles
     */
    public static function inlineTextStylesProvider()
    {
        return [[[new \Urbania\AppleNews\Format\InlineTextStyle()]]];
    }

    /**
     * Test the property layout
     * @test
     * @dataProvider layoutProvider
     * @covers ::getLayout
     * @covers ::setLayout
     */
    public function testPropertyLayout($value)
    {
        $object = new Heading();
        $object->setLayout($value);

        $this->assertEquals($value, $object->getLayout());
    }

    /**
     * Data provider for property layout
     */
    public static function layoutProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ComponentLayout()],
            ["a string"]
        ];
    }

    /**
     * Test the property style
     * @test
     * @dataProvider styleProvider
     * @covers ::getStyle
     * @covers ::setStyle
     */
    public function testPropertyStyle($value)
    {
        $object = new Heading();
        $object->setStyle($value);

        $this->assertEquals($value, $object->getStyle());
    }

    /**
     * Data provider for property style
     */
    public static function styleProvider()
    {
        return [[new \Urbania\AppleNews\Format\ComponentStyle()], ["a string"]];
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
        $object = new Heading();
        $object->setTextStyle($value);

        $this->assertEquals($value, $object->getTextStyle());
    }

    /**
     * Data provider for property textStyle
     */
    public static function textStyleProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\ComponentTextStyle()],
            ["a string"]
        ];
    }
}
