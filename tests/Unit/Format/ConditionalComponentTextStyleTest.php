<?php

namespace Urbania\AppleNews\Tests\Unit\Format;

use Urbania\AppleNews\Format\ConditionalComponentTextStyle;
use Urbania\AppleNews\Tests\TestCase;

/**
 * @coversDefaultClass \Urbania\AppleNews\Format\ConditionalComponentTextStyle
 */
class ConditionalComponentTextStyleTest extends TestCase
{
    /**
     * Test the property conditions
     * @test
     * @dataProvider conditionsProvider
     * @covers ::getConditions
     * @covers ::setConditions
     */
    public function testPropertyConditions($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setConditions($value);

        $this->assertEquals($value, $object->getConditions());
    }

    /**
     * Data provider for property conditions
     */
    public static function conditionsProvider()
    {
        return [
            [new \Urbania\AppleNews\Format\Condition()],
            [[new \Urbania\AppleNews\Format\Condition()]],
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
        $object = new ConditionalComponentTextStyle();
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
     * Test the property dropCapStyle
     * @test
     * @dataProvider dropCapStyleProvider
     * @covers ::getDropCapStyle
     * @covers ::setDropCapStyle
     */
    public function testPropertyDropCapStyle($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setDropCapStyle($value);

        $this->assertEquals($value, $object->getDropCapStyle());
    }

    /**
     * Data provider for property dropCapStyle
     */
    public static function dropCapStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\DropCapStyle()], ['none']];
    }

    /**
     * Test the property firstLineIndent
     * @test
     * @dataProvider firstLineIndentProvider
     * @covers ::getFirstLineIndent
     * @covers ::setFirstLineIndent
     */
    public function testPropertyFirstLineIndent($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setFirstLineIndent($value);

        $this->assertEquals($value, $object->getFirstLineIndent());
    }

    /**
     * Data provider for property firstLineIndent
     */
    public static function firstLineIndentProvider()
    {
        return [[1]];
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontFamily($value);

        $this->assertEquals($value, $object->getFontFamily());
    }

    /**
     * Data provider for property fontFamily
     */
    public static function fontFamilyProvider()
    {
        return [['system']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontName($value);

        $this->assertEquals($value, $object->getFontName());
    }

    /**
     * Data provider for property fontName
     */
    public static function fontNameProvider()
    {
        return [['a string']];
    }

    /**
     * Test the property fontScaling
     * @test
     * @dataProvider fontScalingProvider
     * @covers ::getFontScaling
     * @covers ::setFontScaling
     */
    public function testPropertyFontScaling($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setFontScaling($value);

        $this->assertEquals($value, $object->getFontScaling());
    }

    /**
     * Data provider for property fontScaling
     */
    public static function fontScalingProvider()
    {
        return [[true], [false]];
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontSize($value);

        $this->assertEquals($value, $object->getFontSize());
    }

    /**
     * Data provider for property fontSize
     */
    public static function fontSizeProvider()
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontStyle($value);

        $this->assertEquals($value, $object->getFontStyle());
    }

    /**
     * Data provider for property fontStyle
     */
    public static function fontStyleProvider()
    {
        return [['normal'], ['italic'], ['oblique']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontWeight($value);

        $this->assertEquals($value, $object->getFontWeight());
    }

    /**
     * Data provider for property fontWeight
     */
    public static function fontWeightProvider()
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
            ['thin'],
            ['extra-light'],
            ['extralight'],
            ['ultra-light'],
            ['light'],
            ['regular'],
            ['normal'],
            ['book'],
            ['roman'],
            ['medium'],
            ['semi-bold'],
            ['semibold'],
            ['demi-bold'],
            ['demibold'],
            ['bold'],
            ['extra-bold'],
            ['extrabold'],
            ['ultra-bold'],
            ['ultrabold'],
            ['black'],
            ['heavy'],
            ['lighter'],
            ['bolder'],
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
        $object = new ConditionalComponentTextStyle();
        $object->setFontWidth($value);

        $this->assertEquals($value, $object->getFontWidth());
    }

    /**
     * Data provider for property fontWidth
     */
    public static function fontWidthProvider()
    {
        return [
            ['ultra-compressed'],
            ['extra-compressed'],
            ['compressed'],
            ['ultra-condensed'],
            ['extra-condensed'],
            ['condensed'],
            ['semi-condensed'],
            ['normal'],
            ['semi-expanded'],
            ['expanded'],
            ['extra-expanded'],
            ['ultra-expanded'],
        ];
    }

    /**
     * Test the property hangingPunctuation
     * @test
     * @dataProvider hangingPunctuationProvider
     * @covers ::getHangingPunctuation
     * @covers ::setHangingPunctuation
     */
    public function testPropertyHangingPunctuation($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHangingPunctuation($value);

        $this->assertEquals($value, $object->getHangingPunctuation());
    }

    /**
     * Data provider for property hangingPunctuation
     */
    public static function hangingPunctuationProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property hyphenation
     * @test
     * @dataProvider hyphenationProvider
     * @covers ::getHyphenation
     * @covers ::setHyphenation
     */
    public function testPropertyHyphenation($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHyphenation($value);

        $this->assertEquals($value, $object->getHyphenation());
    }

    /**
     * Data provider for property hyphenation
     */
    public static function hyphenationProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property hyphenationMinimumCharactersAfter
     * @test
     * @dataProvider hyphenationMinimumCharactersAfterProvider
     * @covers ::getHyphenationMinimumCharactersAfter
     * @covers ::setHyphenationMinimumCharactersAfter
     */
    public function testPropertyHyphenationMinimumCharactersAfter($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHyphenationMinimumCharactersAfter($value);

        $this->assertEquals($value, $object->getHyphenationMinimumCharactersAfter());
    }

    /**
     * Data provider for property hyphenationMinimumCharactersAfter
     */
    public static function hyphenationMinimumCharactersAfterProvider()
    {
        return [[1]];
    }

    /**
     * Test the property hyphenationMinimumCharactersBefore
     * @test
     * @dataProvider hyphenationMinimumCharactersBeforeProvider
     * @covers ::getHyphenationMinimumCharactersBefore
     * @covers ::setHyphenationMinimumCharactersBefore
     */
    public function testPropertyHyphenationMinimumCharactersBefore($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHyphenationMinimumCharactersBefore($value);

        $this->assertEquals($value, $object->getHyphenationMinimumCharactersBefore());
    }

    /**
     * Data provider for property hyphenationMinimumCharactersBefore
     */
    public static function hyphenationMinimumCharactersBeforeProvider()
    {
        return [[1]];
    }

    /**
     * Test the property hyphenationMinimumWordLength
     * @test
     * @dataProvider hyphenationMinimumWordLengthProvider
     * @covers ::getHyphenationMinimumWordLength
     * @covers ::setHyphenationMinimumWordLength
     */
    public function testPropertyHyphenationMinimumWordLength($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHyphenationMinimumWordLength($value);

        $this->assertEquals($value, $object->getHyphenationMinimumWordLength());
    }

    /**
     * Data provider for property hyphenationMinimumWordLength
     */
    public static function hyphenationMinimumWordLengthProvider()
    {
        return [[1]];
    }

    /**
     * Test the property hyphenationZone
     * @test
     * @dataProvider hyphenationZoneProvider
     * @covers ::getHyphenationZone
     * @covers ::setHyphenationZone
     */
    public function testPropertyHyphenationZone($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setHyphenationZone($value);

        $this->assertEquals($value, $object->getHyphenationZone());
    }

    /**
     * Data provider for property hyphenationZone
     */
    public static function hyphenationZoneProvider()
    {
        return [[1]];
    }

    /**
     * Test the property lineBalancing
     * @test
     * @dataProvider lineBalancingProvider
     * @covers ::getLineBalancing
     * @covers ::setLineBalancing
     */
    public function testPropertyLineBalancing($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setLineBalancing($value);

        $this->assertEquals($value, $object->getLineBalancing());
    }

    /**
     * Data provider for property lineBalancing
     */
    public static function lineBalancingProvider()
    {
        return [[true], [false]];
    }

    /**
     * Test the property lineHeight
     * @test
     * @dataProvider lineHeightProvider
     * @covers ::getLineHeight
     * @covers ::setLineHeight
     */
    public function testPropertyLineHeight($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setLineHeight($value);

        $this->assertEquals($value, $object->getLineHeight());
    }

    /**
     * Data provider for property lineHeight
     */
    public static function lineHeightProvider()
    {
        return [[1]];
    }

    /**
     * Test the property linkStyle
     * @test
     * @dataProvider linkStyleProvider
     * @covers ::getLinkStyle
     * @covers ::setLinkStyle
     */
    public function testPropertyLinkStyle($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setLinkStyle($value);

        $this->assertEquals($value, $object->getLinkStyle());
    }

    /**
     * Data provider for property linkStyle
     */
    public static function linkStyleProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextStyle()], ['none']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setOrderedListItems($value);

        $this->assertEquals($value, $object->getOrderedListItems());
    }

    /**
     * Data provider for property orderedListItems
     */
    public static function orderedListItemsProvider()
    {
        return [[new \Urbania\AppleNews\Format\ListItemStyle()], ['none']];
    }

    /**
     * Test the property paragraphSpacingAfter
     * @test
     * @dataProvider paragraphSpacingAfterProvider
     * @covers ::getParagraphSpacingAfter
     * @covers ::setParagraphSpacingAfter
     */
    public function testPropertyParagraphSpacingAfter($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setParagraphSpacingAfter($value);

        $this->assertEquals($value, $object->getParagraphSpacingAfter());
    }

    /**
     * Data provider for property paragraphSpacingAfter
     */
    public static function paragraphSpacingAfterProvider()
    {
        return [[1]];
    }

    /**
     * Test the property paragraphSpacingBefore
     * @test
     * @dataProvider paragraphSpacingBeforeProvider
     * @covers ::getParagraphSpacingBefore
     * @covers ::setParagraphSpacingBefore
     */
    public function testPropertyParagraphSpacingBefore($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setParagraphSpacingBefore($value);

        $this->assertEquals($value, $object->getParagraphSpacingBefore());
    }

    /**
     * Data provider for property paragraphSpacingBefore
     */
    public static function paragraphSpacingBeforeProvider()
    {
        return [[1]];
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
        $object = new ConditionalComponentTextStyle();
        $object->setStrikethrough($value);

        $this->assertEquals($value, $object->getStrikethrough());
    }

    /**
     * Data provider for property strikethrough
     */
    public static function strikethroughProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextDecoration()], [true], [false]];
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
        $object = new ConditionalComponentTextStyle();
        $object->setStroke($value);

        $this->assertEquals($value, $object->getStroke());
    }

    /**
     * Data provider for property stroke
     */
    public static function strokeProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextStrokeStyle()], ['none']];
    }

    /**
     * Test the property textAlignment
     * @test
     * @dataProvider textAlignmentProvider
     * @covers ::getTextAlignment
     * @covers ::setTextAlignment
     */
    public function testPropertyTextAlignment($value)
    {
        $object = new ConditionalComponentTextStyle();
        $object->setTextAlignment($value);

        $this->assertEquals($value, $object->getTextAlignment());
    }

    /**
     * Data provider for property textAlignment
     */
    public static function textAlignmentProvider()
    {
        return [['left'], ['center'], ['right'], ['justified'], ['none']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setTextColor($value);

        $this->assertEquals($value, $object->getTextColor());
    }

    /**
     * Data provider for property textColor
     */
    public static function textColorProvider()
    {
        return [['#fff'], ['#000']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setTextShadow($value);

        $this->assertEquals($value, $object->getTextShadow());
    }

    /**
     * Data provider for property textShadow
     */
    public static function textShadowProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextShadow()], ['none']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setTextTransform($value);

        $this->assertEquals($value, $object->getTextTransform());
    }

    /**
     * Data provider for property textTransform
     */
    public static function textTransformProvider()
    {
        return [['uppercase'], ['lowercase'], ['capitalize'], ['smallcaps'], ['none']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setTracking($value);

        $this->assertEquals($value, $object->getTracking());
    }

    /**
     * Data provider for property tracking
     */
    public static function trackingProvider()
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
        $object = new ConditionalComponentTextStyle();
        $object->setUnderline($value);

        $this->assertEquals($value, $object->getUnderline());
    }

    /**
     * Data provider for property underline
     */
    public static function underlineProvider()
    {
        return [[new \Urbania\AppleNews\Format\TextDecoration()], [true], [false]];
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
        $object = new ConditionalComponentTextStyle();
        $object->setUnorderedListItems($value);

        $this->assertEquals($value, $object->getUnorderedListItems());
    }

    /**
     * Data provider for property unorderedListItems
     */
    public static function unorderedListItemsProvider()
    {
        return [[new \Urbania\AppleNews\Format\ListItemStyle()], ['none']];
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
        $object = new ConditionalComponentTextStyle();
        $object->setVerticalAlignment($value);

        $this->assertEquals($value, $object->getVerticalAlignment());
    }

    /**
     * Data provider for property verticalAlignment
     */
    public static function verticalAlignmentProvider()
    {
        return [['superscript'], ['subscript'], ['baseline']];
    }
}
