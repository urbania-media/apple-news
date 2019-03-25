<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\Text;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\Text
 */
class TextTest extends TestCase
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
        $object = new Text();
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
        $object = new Text();
        $object->setFormat($value);

        $this->assertEquals($value, $object->getFormat());
    }

    /**
     * Data provider for property format
     */
    public function formatProvider()
    {
        return [["markdown"], ["html"], ["none"]];
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
        $object = new Text();
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
     * Test the property role
     * @test
     * @dataProvider roleProvider
     * @covers ::getRole
     * @covers ::setRole
     */
    public function testPropertyRole($value)
    {
        $object = new Text();
        $object->setRole($value);

        $this->assertEquals($value, $object->getRole());
    }

    /**
     * Data provider for property role
     */
    public function roleProvider()
    {
        return [["a string"]];
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
        $object = new Text();
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
        $object = new Text();
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
}