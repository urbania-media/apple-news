<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\FormattedText;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\FormattedText
 */
class FormattedTextTest extends TestCase
{
    /**
     * Test the property additions
     * @test
     * @dataProvider additionsProvider
     * @covers ::getAdditions
     * @covers ::setAdditions
     */
    public function testPropertyAdditions($value)
    {
        $object = new FormattedText();
        $object->setAdditions($value);

        $this->assertEquals($value, $object->getAdditions());
    }

    /**
     * Data provider for property additions
     */
    public function additionsProvider()
    {
        return [[[new \Urbania\AppleNews\Format\Addition()]]];
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
        $object = new FormattedText();
        $object->setFormat($value);

        $this->assertEquals($value, $object->getFormat());
    }

    /**
     * Data provider for property format
     */
    public function formatProvider()
    {
        return [["html"], ["none"]];
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
        $object = new FormattedText();
        $object->setInlineTextStyles($value);

        $this->assertEquals($value, $object->getInlineTextStyles());
    }

    /**
     * Data provider for property inlineTextStyles
     */
    public function inlineTextStylesProvider()
    {
        return [[[new \Urbania\AppleNews\Format\InlineTextStyle()]]];
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
        $object = new FormattedText();
        $object->setText($value);

        $this->assertEquals($value, $object->getText());
    }

    /**
     * Data provider for property text
     */
    public function textProvider()
    {
        return [["a string"]];
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
        $object = new FormattedText();
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
     * Test the property type
     * @test
     * @dataProvider typeProvider
     * @covers ::getType
     */
    public function testPropertyType($value)
    {
        $object = new FormattedText();

        $this->assertEquals($value, $object->getType());
    }

    /**
     * Data provider for property type
     */
    public function typeProvider()
    {
        return [["formatted_text"]];
    }
}
