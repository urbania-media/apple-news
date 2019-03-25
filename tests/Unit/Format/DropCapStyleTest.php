<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\DropCapStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\DropCapStyle
 */
class DropCapStyleTest extends TestCase
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
        $object = new DropCapStyle();
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
     * Test the property fontName
     * @test
     * @dataProvider fontNameProvider
     * @covers ::getFontName
     * @covers ::setFontName
     */
    public function testPropertyFontName($value)
    {
        $object = new DropCapStyle();
        $object->setFontName($value);

        $this->assertEquals($value, $object->getFontName());
    }

    /**
     * Data provider for property fontName
     */
    public function fontNameProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property numberOfCharacters
     * @test
     * @dataProvider numberOfCharactersProvider
     * @covers ::getNumberOfCharacters
     * @covers ::setNumberOfCharacters
     */
    public function testPropertyNumberOfCharacters($value)
    {
        $object = new DropCapStyle();
        $object->setNumberOfCharacters($value);

        $this->assertEquals($value, $object->getNumberOfCharacters());
    }

    /**
     * Data provider for property numberOfCharacters
     */
    public function numberOfCharactersProvider()
    {
        return [[1]];
    }

    /**
     * Test the property numberOfLines
     * @test
     * @dataProvider numberOfLinesProvider
     * @covers ::getNumberOfLines
     * @covers ::setNumberOfLines
     */
    public function testPropertyNumberOfLines($value)
    {
        $object = new DropCapStyle();
        $object->setNumberOfLines($value);

        $this->assertEquals($value, $object->getNumberOfLines());
    }

    /**
     * Data provider for property numberOfLines
     */
    public function numberOfLinesProvider()
    {
        return [[1]];
    }

    /**
     * Test the property numberOfRaisedLines
     * @test
     * @dataProvider numberOfRaisedLinesProvider
     * @covers ::getNumberOfRaisedLines
     * @covers ::setNumberOfRaisedLines
     */
    public function testPropertyNumberOfRaisedLines($value)
    {
        $object = new DropCapStyle();
        $object->setNumberOfRaisedLines($value);

        $this->assertEquals($value, $object->getNumberOfRaisedLines());
    }

    /**
     * Data provider for property numberOfRaisedLines
     */
    public function numberOfRaisedLinesProvider()
    {
        return [[1]];
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
        $object = new DropCapStyle();
        $object->setPadding($value);

        $this->assertEquals($value, $object->getPadding());
    }

    /**
     * Data provider for property padding
     */
    public function paddingProvider()
    {
        return [[1]];
    }

    /**
     * Test the property textColor
     * @test
     * @dataProvider textColorProvider
     * @covers ::getTextColor
     * @covers ::setTextColor
     */
    public function testPropertyTextColor($value)
    {
        $object = new DropCapStyle();
        $object->setTextColor($value);

        $this->assertEquals($value, $object->getTextColor());
    }

    /**
     * Data provider for property textColor
     */
    public function textColorProvider()
    {
        return [["#fff"], ["#000"]];
    }
}
