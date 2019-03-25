<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\TextStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\TextStyle
 */
class TextStyleTest extends TestCase
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
        $object = new TextStyle();
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
     * Test the property fontFamily
     * @test
     * @dataProvider fontFamilyProvider
     * @covers ::getFontFamily
     * @covers ::setFontFamily
     */
    public function testPropertyFontFamily($value)
    {
        $object = new TextStyle();
        $object->setFontFamily($value);

        $this->assertEquals($value, $object->getFontFamily());
    }

    /**
     * Data provider for property fontFamily
     */
    public function fontFamilyProvider()
    {
        return [["a string"]];
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
        $object = new TextStyle();
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
     * Test the property fontSize
     * @test
     * @dataProvider fontSizeProvider
     * @covers ::getFontSize
     * @covers ::setFontSize
     */
    public function testPropertyFontSize($value)
    {
        $object = new TextStyle();
        $object->setFontSize($value);

        $this->assertEquals($value, $object->getFontSize());
    }

    /**
     * Data provider for property fontSize
     */
    public function fontSizeProvider()
    {
        return [[1]];
    }

    /**
     * Test the property fontStyle
     * @test
     * @dataProvider fontStyleProvider
     * @covers ::getFontStyle
     * @covers ::setFontStyle
     */
    public function testPropertyFontStyle($value)
    {
        $object = new TextStyle();
        $object->setFontStyle($value);

        $this->assertEquals($value, $object->getFontStyle());
    }

    /**
     * Data provider for property fontStyle
     */
    public function fontStyleProvider()
    {
        return [["normal"], ["italic"], ["oblique"]];
    }

    /**
     * Test the property fontWeight
     * @test
     * @dataProvider fontWeightProvider
     * @covers ::getFontWeight
     * @covers ::setFontWeight
     */
    public function testPropertyFontWeight($value)
    {
        $object = new TextStyle();
        $object->setFontWeight($value);

        $this->assertEquals($value, $object->getFontWeight());
    }

    /**
     * Data provider for property fontWeight
     */
    public function fontWeightProvider()
    {
        return [
            [100],
            [200],
            [300],
            [400],
            [500],
            [600],
            [700],
            [800],
            [900],
            ["thin"],
            ["extra-light"],
            ["extralight"],
            ["ultra-light"],
            ["light"],
            ["regular"],
            ["normal"],
            ["book"],
            ["roman"],
            ["medium"],
            ["semi-bold"],
            ["semibold"],
            ["demi-bold"],
            ["demibold"],
            ["bold"],
            ["extra-bold"],
            ["extrabold"],
            ["ultra-bold"],
            ["ultrabold"],
            ["black"],
            ["heavy"],
            ["lighter"],
            ["bolder"]
        ];
    }

    /**
     * Test the property fontWidth
     * @test
     * @dataProvider fontWidthProvider
     * @covers ::getFontWidth
     * @covers ::setFontWidth
     */
    public function testPropertyFontWidth($value)
    {
        $object = new TextStyle();
        $object->setFontWidth($value);

        $this->assertEquals($value, $object->getFontWidth());
    }

    /**
     * Data provider for property fontWidth
     */
    public function fontWidthProvider()
    {
        return [
            ["ultra-condensed"],
            ["extra-condensed"],
            ["condensed"],
            ["semi-condensed"],
            ["normal"],
            ["semi-expanded"],
            ["expanded"],
            ["extra-expanded"],
            ["ultra-expanded"]
        ];
    }

    /**
     * Test the property orderedListItems
     * @test
     * @dataProvider orderedListItemsProvider
     * @covers ::getOrderedListItems
     * @covers ::setOrderedListItems
     */
    public function testPropertyOrderedListItems($value)
    {
        $object = new TextStyle();
        $object->setOrderedListItems($value);

        $this->assertEquals($value, $object->getOrderedListItems());
    }

    /**
     * Data provider for property orderedListItems
     */
    public function orderedListItemsProvider()
    {
        return [[new \Urbania\AppleNews\Format\ListItemStyle()]];
    }

    /**
     * Test the property strikethrough
     * @test
     * @dataProvider strikethroughProvider
     * @covers ::getStrikethrough
     * @covers ::setStrikethrough
     */
    public function testPropertyStrikethrough($value)
    {
        $object = new TextStyle();
        $object->setStrikethrough($value);

        $this->assertEquals($value, $object->getStrikethrough());
    }

    /**
     * Data provider for property strikethrough
     */
    public function strikethroughProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextDecoration()]];
    }

    /**
     * Test the property stroke
     * @test
     * @dataProvider strokeProvider
     * @covers ::getStroke
     * @covers ::setStroke
     */
    public function testPropertyStroke($value)
    {
        $object = new TextStyle();
        $object->setStroke($value);

        $this->assertEquals($value, $object->getStroke());
    }

    /**
     * Data provider for property stroke
     */
    public function strokeProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextStrokeStyle()]];
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
        $object = new TextStyle();
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

    /**
     * Test the property textShadow
     * @test
     * @dataProvider textShadowProvider
     * @covers ::getTextShadow
     * @covers ::setTextShadow
     */
    public function testPropertyTextShadow($value)
    {
        $object = new TextStyle();
        $object->setTextShadow($value);

        $this->assertEquals($value, $object->getTextShadow());
    }

    /**
     * Data provider for property textShadow
     */
    public function textShadowProvider()
    {
        return [[new \Urbania\AppleNews\Format\Shadow()]];
    }

    /**
     * Test the property tracking
     * @test
     * @dataProvider trackingProvider
     * @covers ::getTracking
     * @covers ::setTracking
     */
    public function testPropertyTracking($value)
    {
        $object = new TextStyle();
        $object->setTracking($value);

        $this->assertEquals($value, $object->getTracking());
    }

    /**
     * Data provider for property tracking
     */
    public function trackingProvider()
    {
        return [[1.1], [1]];
    }

    /**
     * Test the property underline
     * @test
     * @dataProvider underlineProvider
     * @covers ::getUnderline
     * @covers ::setUnderline
     */
    public function testPropertyUnderline($value)
    {
        $object = new TextStyle();
        $object->setUnderline($value);

        $this->assertEquals($value, $object->getUnderline());
    }

    /**
     * Data provider for property underline
     */
    public function underlineProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextDecoration()]];
    }

    /**
     * Test the property unorderedListItems
     * @test
     * @dataProvider unorderedListItemsProvider
     * @covers ::getUnorderedListItems
     * @covers ::setUnorderedListItems
     */
    public function testPropertyUnorderedListItems($value)
    {
        $object = new TextStyle();
        $object->setUnorderedListItems($value);

        $this->assertEquals($value, $object->getUnorderedListItems());
    }

    /**
     * Data provider for property unorderedListItems
     */
    public function unorderedListItemsProvider()
    {
        return [[new \Urbania\AppleNews\Format\ListItemStyle()]];
    }

    /**
     * Test the property verticalAlignment
     * @test
     * @dataProvider verticalAlignmentProvider
     * @covers ::getVerticalAlignment
     * @covers ::setVerticalAlignment
     */
    public function testPropertyVerticalAlignment($value)
    {
        $object = new TextStyle();
        $object->setVerticalAlignment($value);

        $this->assertEquals($value, $object->getVerticalAlignment());
    }

    /**
     * Data provider for property verticalAlignment
     */
    public function verticalAlignmentProvider()
    {
        return [["a string"]];
    }

    /**
     * Test the property textTransform
     * @test
     * @dataProvider textTransformProvider
     * @covers ::getTextTransform
     * @covers ::setTextTransform
     */
    public function testPropertyTextTransform($value)
    {
        $object = new TextStyle();
        $object->setTextTransform($value);

        $this->assertEquals($value, $object->getTextTransform());
    }

    /**
     * Data provider for property textTransform
     */
    public function textTransformProvider()
    {
        return [["a string"]];
    }
}
