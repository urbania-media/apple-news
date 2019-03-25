<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining conditional properties for a component text
 * style, and when the conditional properties are in effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/conditionalcomponenttextstyle
 */
class ConditionalComponentTextStyle extends TextStyle
{
    /**
     * An array of conditions that, when met, cause the conditional component
     * text style properties to be in effect.
     * @var Format\Condition[]
     */
    protected $conditions;

    /**
     * The background color for text lines. This value defaults to
     * transparent.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The style of drop cap to apply to the first paragraph of the
     * component.
     * @var \Urbania\AppleNews\Format\DropCapStyle
     */
    protected $dropCapStyle;

    /**
     * The indent, in points, of the first line of each paragraph.
     * @var integer
     */
    protected $firstLineIndent;

    /**
     * The font family to use for text rendering; for example, Gill Sans.
     * Using a combination of fontFamily, fontWeight, and fontStyle, you can
     * define the appearance of the text. Apple News automatically selects
     * the appropriate font variant from the available variants in that
     * family.
     * @var string
     */
    protected $fontFamily;

    /**
     * The font name to use to refer to an explicit font variant's PostScript
     * name, such as GillSans-Bold. Alternatively, you can use a combination
     * of fontFamily, fontWeight, and fontStyle to have Apple News
     * automatically select the appropriate variant depending on the text
     * formatting used.
     * @var string
     */
    protected $fontName;

    /**
     * The size of the font, in points. By default, the font size is
     * inherited from a parent component or a default style. As a best
     * practice, try not to go below 16 points for body text. The fontSize
     * may be automatically resized for different device sizes or for iOS
     * devices with Larger Accessibility Sizes enabled.
     * @var integer
     */
    protected $fontSize;

    /**
     * The font style to apply for the selected font.
     * @var string
     */
    protected $fontStyle;

    /**
     * The font weight to apply for the selected font. In addition to
     * explicit weights (named or numerical), lighter and bolder are
     * available, to set text in a lighter or bolder font as compared to the
     * surrounding text.
     * @var integer|string
     */
    protected $fontWeight;

    /**
     * The font width for the selected font (known in CSS as font-stretch).
     * This value defines the width characteristics of a font variant between
     * normal, condensed, and expanded. Some font families are categorized by
     * width (for example, Avenir Next and Avenir Next Condensed), so make
     * sure that the font family you select supports the specified font
     * width.
     * @var string
     */
    protected $fontWidth;

    /**
     * A Boolean that defines whether punctuation should be positioned
     * outside the margins of the body text.
     * @var boolean
     */
    protected $hangingPunctuation;

    /**
     * A Boolean that indicates whether text should be hyphenated when
     * necessary. By default, only components with the role body or intro
     * have hyphenation enabled. All other components default to false.
     * @var boolean
     */
    protected $hyphenation;

    /**
     * The default line height, in points. The line height is recalculated as
     * necessary, relative to the font size. For example, when the font is
     * automatically resized to fit a smaller screen, the line height is also
     * adjusted accordingly.
     * @var integer
     */
    protected $lineHeight;

    /**
     * Text styling for all links within a text component.
     * @var \Urbania\AppleNews\Format\TextStyle
     */
    protected $linkStyle;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an orderedListItems definition to
     * configure how to display list items inside <ol> tags.
     * @var \Urbania\AppleNews\Format\ListItemStyle
     */
    protected $orderedListItems;

    /**
     * An object that defines the spacing, in points, after each paragraph,
     * relative to the line height.
     * @var integer
     */
    protected $paragraphSpacingAfter;

    /**
     * An object that defines the spacing, in points, before each paragraph,
     * relative to the line height.
     * @var integer
     */
    protected $paragraphSpacingBefore;

    /**
     * The text strikethrough. Set strikethrough to true to use the text
     * color inherited from the textColor property as the strikethrough
     * color, or provide a text decoration definition with a different color.
     * By default, strikethrough is omitted (false).
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $strikethrough;

    /**
     * The stroke style for the text outline. By default, stroke is omitted.
     * @var \Urbania\AppleNews\Format\TextStrokeStyle
     */
    protected $stroke;

    /**
     * The justification for all text within the component.
     * @var string
     */
    protected $textAlignment;

    /**
     * The text color to apply to the selected text.
     * @var string
     */
    protected $textColor;

    /**
     * The text shadow for this style.
     * @var \Urbania\AppleNews\Format\Shadow
     */
    protected $textShadow;

    /**
     * The transform to apply to the text.
     * @var string
     */
    protected $textTransform;

    /**
     * The amount of tracking (spacing between characters) in text, as a
     * percentage of the font size. The actual spacing between letters is
     * determined by combining information from the font and font size.
     * @var float|integer
     */
    protected $tracking;

    /**
     * The text underlining. You can use this style for links. Set underline
     * to true to use the text color as the underline color, or provide a
     * text decoration with a different color. By default, underline is
     * omitted (false).
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $underline;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an unorderedListItems definition to
     * configure how to display list items inside <ul> tags.
     * @var \Urbania\AppleNews\Format\ListItemStyle
     */
    protected $unorderedListItems;

    /**
     * The vertical alignment of the text. You can use this property for
     * superscript and subscript.
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['conditions'])) {
            $this->setConditions($data['conditions']);
        }

        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['dropCapStyle'])) {
            $this->setDropCapStyle($data['dropCapStyle']);
        }

        if (isset($data['firstLineIndent'])) {
            $this->setFirstLineIndent($data['firstLineIndent']);
        }

        if (isset($data['fontFamily'])) {
            $this->setFontFamily($data['fontFamily']);
        }

        if (isset($data['fontName'])) {
            $this->setFontName($data['fontName']);
        }

        if (isset($data['fontSize'])) {
            $this->setFontSize($data['fontSize']);
        }

        if (isset($data['fontStyle'])) {
            $this->setFontStyle($data['fontStyle']);
        }

        if (isset($data['fontWeight'])) {
            $this->setFontWeight($data['fontWeight']);
        }

        if (isset($data['fontWidth'])) {
            $this->setFontWidth($data['fontWidth']);
        }

        if (isset($data['hangingPunctuation'])) {
            $this->setHangingPunctuation($data['hangingPunctuation']);
        }

        if (isset($data['hyphenation'])) {
            $this->setHyphenation($data['hyphenation']);
        }

        if (isset($data['lineHeight'])) {
            $this->setLineHeight($data['lineHeight']);
        }

        if (isset($data['linkStyle'])) {
            $this->setLinkStyle($data['linkStyle']);
        }

        if (isset($data['orderedListItems'])) {
            $this->setOrderedListItems($data['orderedListItems']);
        }

        if (isset($data['paragraphSpacingAfter'])) {
            $this->setParagraphSpacingAfter($data['paragraphSpacingAfter']);
        }

        if (isset($data['paragraphSpacingBefore'])) {
            $this->setParagraphSpacingBefore($data['paragraphSpacingBefore']);
        }

        if (isset($data['strikethrough'])) {
            $this->setStrikethrough($data['strikethrough']);
        }

        if (isset($data['stroke'])) {
            $this->setStroke($data['stroke']);
        }

        if (isset($data['textAlignment'])) {
            $this->setTextAlignment($data['textAlignment']);
        }

        if (isset($data['textColor'])) {
            $this->setTextColor($data['textColor']);
        }

        if (isset($data['textShadow'])) {
            $this->setTextShadow($data['textShadow']);
        }

        if (isset($data['textTransform'])) {
            $this->setTextTransform($data['textTransform']);
        }

        if (isset($data['tracking'])) {
            $this->setTracking($data['tracking']);
        }

        if (isset($data['underline'])) {
            $this->setUnderline($data['underline']);
        }

        if (isset($data['unorderedListItems'])) {
            $this->setUnorderedListItems($data['unorderedListItems']);
        }

        if (isset($data['verticalAlignment'])) {
            $this->setVerticalAlignment($data['verticalAlignment']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Add an item to conditions
     * @param \Urbania\AppleNews\Format\Condition|array $item
     * @return $this
     */
    public function addCondition($item)
    {
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, [$item])
                : [$item]
        );
    }

    /**
     * Add items to conditions
     * @param array $items
     * @return $this
     */
    public function addConditions($items)
    {
        Assert::isArray($items);
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, $items)
                : $items
        );
    }

    /**
     * Get the conditions
     * @return Format\Condition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the conditions
     * @param Format\Condition[] $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        Assert::isArray($conditions);
        Assert::allIsSdkObject($conditions, Condition::class);

        $this->conditions = array_reduce(
            array_keys($conditions),
            function ($array, $key) use ($conditions) {
                $item = $conditions[$key];
                $array[$key] = is_array($item) ? new Condition($item) : $item;
                return $array;
            },
            []
        );
        return $this;
    }

    /**
     * Get the dropCapStyle
     * @return \Urbania\AppleNews\Format\DropCapStyle
     */
    public function getDropCapStyle()
    {
        return $this->dropCapStyle;
    }

    /**
     * Set the dropCapStyle
     * @param \Urbania\AppleNews\Format\DropCapStyle|array $dropCapStyle
     * @return $this
     */
    public function setDropCapStyle($dropCapStyle)
    {
        if (is_null($dropCapStyle)) {
            $this->dropCapStyle = null;
            return $this;
        }

        Assert::isSdkObject($dropCapStyle, DropCapStyle::class);

        $this->dropCapStyle = is_array($dropCapStyle)
            ? new DropCapStyle($dropCapStyle)
            : $dropCapStyle;
        return $this;
    }

    /**
     * Get the firstLineIndent
     * @return integer
     */
    public function getFirstLineIndent()
    {
        return $this->firstLineIndent;
    }

    /**
     * Set the firstLineIndent
     * @param integer $firstLineIndent
     * @return $this
     */
    public function setFirstLineIndent($firstLineIndent)
    {
        if (is_null($firstLineIndent)) {
            $this->firstLineIndent = null;
            return $this;
        }

        Assert::integer($firstLineIndent);

        $this->firstLineIndent = $firstLineIndent;
        return $this;
    }

    /**
     * Get the fontFamily
     * @return string
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * Set the fontFamily
     * @param string $fontFamily
     * @return $this
     */
    public function setFontFamily($fontFamily)
    {
        if (is_null($fontFamily)) {
            $this->fontFamily = null;
            return $this;
        }

        Assert::string($fontFamily);

        $this->fontFamily = $fontFamily;
        return $this;
    }

    /**
     * Get the fontName
     * @return string
     */
    public function getFontName()
    {
        return $this->fontName;
    }

    /**
     * Set the fontName
     * @param string $fontName
     * @return $this
     */
    public function setFontName($fontName)
    {
        if (is_null($fontName)) {
            $this->fontName = null;
            return $this;
        }

        Assert::string($fontName);

        $this->fontName = $fontName;
        return $this;
    }

    /**
     * Get the fontSize
     * @return integer
     */
    public function getFontSize()
    {
        return $this->fontSize;
    }

    /**
     * Set the fontSize
     * @param integer $fontSize
     * @return $this
     */
    public function setFontSize($fontSize)
    {
        if (is_null($fontSize)) {
            $this->fontSize = null;
            return $this;
        }

        Assert::integer($fontSize);

        $this->fontSize = $fontSize;
        return $this;
    }

    /**
     * Get the fontStyle
     * @return string
     */
    public function getFontStyle()
    {
        return $this->fontStyle;
    }

    /**
     * Set the fontStyle
     * @param string $fontStyle
     * @return $this
     */
    public function setFontStyle($fontStyle)
    {
        if (is_null($fontStyle)) {
            $this->fontStyle = null;
            return $this;
        }

        Assert::oneOf($fontStyle, ["normal", "italic", "oblique"]);

        $this->fontStyle = $fontStyle;
        return $this;
    }

    /**
     * Get the fontWeight
     * @return integer|string
     */
    public function getFontWeight()
    {
        return $this->fontWeight;
    }

    /**
     * Set the fontWeight
     * @param integer|string $fontWeight
     * @return $this
     */
    public function setFontWeight($fontWeight)
    {
        if (is_null($fontWeight)) {
            $this->fontWeight = null;
            return $this;
        }

        Assert::oneOf($fontWeight, [
            100,
            200,
            300,
            400,
            500,
            600,
            700,
            800,
            900,
            "thin",
            "extra-light",
            "extralight",
            "ultra-light",
            "light",
            "regular",
            "normal",
            "book",
            "roman",
            "medium",
            "semi-bold",
            "semibold",
            "demi-bold",
            "demibold",
            "bold",
            "extra-bold",
            "extrabold",
            "ultra-bold",
            "ultrabold",
            "black",
            "heavy",
            "lighter",
            "bolder"
        ]);

        $this->fontWeight = $fontWeight;
        return $this;
    }

    /**
     * Get the fontWidth
     * @return string
     */
    public function getFontWidth()
    {
        return $this->fontWidth;
    }

    /**
     * Set the fontWidth
     * @param string $fontWidth
     * @return $this
     */
    public function setFontWidth($fontWidth)
    {
        if (is_null($fontWidth)) {
            $this->fontWidth = null;
            return $this;
        }

        Assert::oneOf($fontWidth, [
            "ultra-condensed",
            "extra-condensed",
            "condensed",
            "semi-condensed",
            "normal",
            "semi-expanded",
            "expanded",
            "extra-expanded",
            "ultra-expanded"
        ]);

        $this->fontWidth = $fontWidth;
        return $this;
    }

    /**
     * Get the hangingPunctuation
     * @return boolean
     */
    public function getHangingPunctuation()
    {
        return $this->hangingPunctuation;
    }

    /**
     * Set the hangingPunctuation
     * @param boolean $hangingPunctuation
     * @return $this
     */
    public function setHangingPunctuation($hangingPunctuation)
    {
        if (is_null($hangingPunctuation)) {
            $this->hangingPunctuation = null;
            return $this;
        }

        Assert::boolean($hangingPunctuation);

        $this->hangingPunctuation = $hangingPunctuation;
        return $this;
    }

    /**
     * Get the hyphenation
     * @return boolean
     */
    public function getHyphenation()
    {
        return $this->hyphenation;
    }

    /**
     * Set the hyphenation
     * @param boolean $hyphenation
     * @return $this
     */
    public function setHyphenation($hyphenation)
    {
        if (is_null($hyphenation)) {
            $this->hyphenation = null;
            return $this;
        }

        Assert::boolean($hyphenation);

        $this->hyphenation = $hyphenation;
        return $this;
    }

    /**
     * Get the lineHeight
     * @return integer
     */
    public function getLineHeight()
    {
        return $this->lineHeight;
    }

    /**
     * Set the lineHeight
     * @param integer $lineHeight
     * @return $this
     */
    public function setLineHeight($lineHeight)
    {
        if (is_null($lineHeight)) {
            $this->lineHeight = null;
            return $this;
        }

        Assert::integer($lineHeight);

        $this->lineHeight = $lineHeight;
        return $this;
    }

    /**
     * Get the linkStyle
     * @return \Urbania\AppleNews\Format\TextStyle
     */
    public function getLinkStyle()
    {
        return $this->linkStyle;
    }

    /**
     * Set the linkStyle
     * @param \Urbania\AppleNews\Format\TextStyle|array $linkStyle
     * @return $this
     */
    public function setLinkStyle($linkStyle)
    {
        if (is_null($linkStyle)) {
            $this->linkStyle = null;
            return $this;
        }

        Assert::isSdkObject($linkStyle, TextStyle::class);

        $this->linkStyle = is_array($linkStyle)
            ? new TextStyle($linkStyle)
            : $linkStyle;
        return $this;
    }

    /**
     * Get the orderedListItems
     * @return \Urbania\AppleNews\Format\ListItemStyle
     */
    public function getOrderedListItems()
    {
        return $this->orderedListItems;
    }

    /**
     * Set the orderedListItems
     * @param \Urbania\AppleNews\Format\ListItemStyle|array $orderedListItems
     * @return $this
     */
    public function setOrderedListItems($orderedListItems)
    {
        if (is_null($orderedListItems)) {
            $this->orderedListItems = null;
            return $this;
        }

        Assert::isSdkObject($orderedListItems, ListItemStyle::class);

        $this->orderedListItems = is_array($orderedListItems)
            ? new ListItemStyle($orderedListItems)
            : $orderedListItems;
        return $this;
    }

    /**
     * Get the paragraphSpacingAfter
     * @return integer
     */
    public function getParagraphSpacingAfter()
    {
        return $this->paragraphSpacingAfter;
    }

    /**
     * Set the paragraphSpacingAfter
     * @param integer $paragraphSpacingAfter
     * @return $this
     */
    public function setParagraphSpacingAfter($paragraphSpacingAfter)
    {
        if (is_null($paragraphSpacingAfter)) {
            $this->paragraphSpacingAfter = null;
            return $this;
        }

        Assert::integer($paragraphSpacingAfter);

        $this->paragraphSpacingAfter = $paragraphSpacingAfter;
        return $this;
    }

    /**
     * Get the paragraphSpacingBefore
     * @return integer
     */
    public function getParagraphSpacingBefore()
    {
        return $this->paragraphSpacingBefore;
    }

    /**
     * Set the paragraphSpacingBefore
     * @param integer $paragraphSpacingBefore
     * @return $this
     */
    public function setParagraphSpacingBefore($paragraphSpacingBefore)
    {
        if (is_null($paragraphSpacingBefore)) {
            $this->paragraphSpacingBefore = null;
            return $this;
        }

        Assert::integer($paragraphSpacingBefore);

        $this->paragraphSpacingBefore = $paragraphSpacingBefore;
        return $this;
    }

    /**
     * Get the strikethrough
     * @return \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    public function getStrikethrough()
    {
        return $this->strikethrough;
    }

    /**
     * Set the strikethrough
     * @param \Urbania\AppleNews\Format\TextDecoration|array|boolean $strikethrough
     * @return $this
     */
    public function setStrikethrough($strikethrough)
    {
        if (is_null($strikethrough)) {
            $this->strikethrough = null;
            return $this;
        }

        if (is_object($strikethrough) || is_array($strikethrough)) {
            Assert::isSdkObject($strikethrough, TextDecoration::class);
        } else {
            Assert::boolean($strikethrough);
        }

        $this->strikethrough = is_array($strikethrough)
            ? new TextDecoration($strikethrough)
            : $strikethrough;
        return $this;
    }

    /**
     * Get the stroke
     * @return \Urbania\AppleNews\Format\TextStrokeStyle
     */
    public function getStroke()
    {
        return $this->stroke;
    }

    /**
     * Set the stroke
     * @param \Urbania\AppleNews\Format\TextStrokeStyle|array $stroke
     * @return $this
     */
    public function setStroke($stroke)
    {
        if (is_null($stroke)) {
            $this->stroke = null;
            return $this;
        }

        Assert::isSdkObject($stroke, TextStrokeStyle::class);

        $this->stroke = is_array($stroke)
            ? new TextStrokeStyle($stroke)
            : $stroke;
        return $this;
    }

    /**
     * Get the textAlignment
     * @return string
     */
    public function getTextAlignment()
    {
        return $this->textAlignment;
    }

    /**
     * Set the textAlignment
     * @param string $textAlignment
     * @return $this
     */
    public function setTextAlignment($textAlignment)
    {
        if (is_null($textAlignment)) {
            $this->textAlignment = null;
            return $this;
        }

        Assert::oneOf($textAlignment, [
            "left",
            "center",
            "right",
            "justified",
            "none"
        ]);

        $this->textAlignment = $textAlignment;
        return $this;
    }

    /**
     * Get the textColor
     * @return string
     */
    public function getTextColor()
    {
        return $this->textColor;
    }

    /**
     * Set the textColor
     * @param string $textColor
     * @return $this
     */
    public function setTextColor($textColor)
    {
        if (is_null($textColor)) {
            $this->textColor = null;
            return $this;
        }

        Assert::isColor($textColor);

        $this->textColor = $textColor;
        return $this;
    }

    /**
     * Get the textShadow
     * @return \Urbania\AppleNews\Format\Shadow
     */
    public function getTextShadow()
    {
        return $this->textShadow;
    }

    /**
     * Set the textShadow
     * @param \Urbania\AppleNews\Format\Shadow|array $textShadow
     * @return $this
     */
    public function setTextShadow($textShadow)
    {
        if (is_null($textShadow)) {
            $this->textShadow = null;
            return $this;
        }

        Assert::isSdkObject($textShadow, Shadow::class);

        $this->textShadow = is_array($textShadow)
            ? new Shadow($textShadow)
            : $textShadow;
        return $this;
    }

    /**
     * Get the textTransform
     * @return string
     */
    public function getTextTransform()
    {
        return $this->textTransform;
    }

    /**
     * Set the textTransform
     * @param string $textTransform
     * @return $this
     */
    public function setTextTransform($textTransform)
    {
        if (is_null($textTransform)) {
            $this->textTransform = null;
            return $this;
        }

        Assert::oneOf($textTransform, [
            "uppercase",
            "lowercase",
            "capitalize",
            "none"
        ]);

        $this->textTransform = $textTransform;
        return $this;
    }

    /**
     * Get the tracking
     * @return float|integer
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * Set the tracking
     * @param float|integer $tracking
     * @return $this
     */
    public function setTracking($tracking)
    {
        if (is_null($tracking)) {
            $this->tracking = null;
            return $this;
        }

        Assert::number($tracking);

        $this->tracking = $tracking;
        return $this;
    }

    /**
     * Get the underline
     * @return \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    public function getUnderline()
    {
        return $this->underline;
    }

    /**
     * Set the underline
     * @param \Urbania\AppleNews\Format\TextDecoration|array|boolean $underline
     * @return $this
     */
    public function setUnderline($underline)
    {
        if (is_null($underline)) {
            $this->underline = null;
            return $this;
        }

        if (is_object($underline) || is_array($underline)) {
            Assert::isSdkObject($underline, TextDecoration::class);
        } else {
            Assert::boolean($underline);
        }

        $this->underline = is_array($underline)
            ? new TextDecoration($underline)
            : $underline;
        return $this;
    }

    /**
     * Get the unorderedListItems
     * @return \Urbania\AppleNews\Format\ListItemStyle
     */
    public function getUnorderedListItems()
    {
        return $this->unorderedListItems;
    }

    /**
     * Set the unorderedListItems
     * @param \Urbania\AppleNews\Format\ListItemStyle|array $unorderedListItems
     * @return $this
     */
    public function setUnorderedListItems($unorderedListItems)
    {
        if (is_null($unorderedListItems)) {
            $this->unorderedListItems = null;
            return $this;
        }

        Assert::isSdkObject($unorderedListItems, ListItemStyle::class);

        $this->unorderedListItems = is_array($unorderedListItems)
            ? new ListItemStyle($unorderedListItems)
            : $unorderedListItems;
        return $this;
    }

    /**
     * Get the verticalAlignment
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->verticalAlignment;
    }

    /**
     * Set the verticalAlignment
     * @param string $verticalAlignment
     * @return $this
     */
    public function setVerticalAlignment($verticalAlignment)
    {
        if (is_null($verticalAlignment)) {
            $this->verticalAlignment = null;
            return $this;
        }

        Assert::oneOf($verticalAlignment, [
            "superscript",
            "subscript",
            "baseline"
        ]);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->conditions)) {
            $data['conditions'] = !is_null($this->conditions)
                ? array_reduce(
                    array_keys($this->conditions),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditions[$key] instanceof Arrayable
                                ? $this->conditions[$key]->toArray()
                                : $this->conditions[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditions;
        }
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->dropCapStyle)) {
            $data['dropCapStyle'] =
                $this->dropCapStyle instanceof Arrayable
                    ? $this->dropCapStyle->toArray()
                    : $this->dropCapStyle;
        }
        if (isset($this->firstLineIndent)) {
            $data['firstLineIndent'] = $this->firstLineIndent;
        }
        if (isset($this->fontFamily)) {
            $data['fontFamily'] = $this->fontFamily;
        }
        if (isset($this->fontName)) {
            $data['fontName'] = $this->fontName;
        }
        if (isset($this->fontSize)) {
            $data['fontSize'] = $this->fontSize;
        }
        if (isset($this->fontStyle)) {
            $data['fontStyle'] = $this->fontStyle;
        }
        if (isset($this->fontWeight)) {
            $data['fontWeight'] = $this->fontWeight;
        }
        if (isset($this->fontWidth)) {
            $data['fontWidth'] = $this->fontWidth;
        }
        if (isset($this->hangingPunctuation)) {
            $data['hangingPunctuation'] = $this->hangingPunctuation;
        }
        if (isset($this->hyphenation)) {
            $data['hyphenation'] = $this->hyphenation;
        }
        if (isset($this->lineHeight)) {
            $data['lineHeight'] = $this->lineHeight;
        }
        if (isset($this->linkStyle)) {
            $data['linkStyle'] =
                $this->linkStyle instanceof Arrayable
                    ? $this->linkStyle->toArray()
                    : $this->linkStyle;
        }
        if (isset($this->orderedListItems)) {
            $data['orderedListItems'] =
                $this->orderedListItems instanceof Arrayable
                    ? $this->orderedListItems->toArray()
                    : $this->orderedListItems;
        }
        if (isset($this->paragraphSpacingAfter)) {
            $data['paragraphSpacingAfter'] = $this->paragraphSpacingAfter;
        }
        if (isset($this->paragraphSpacingBefore)) {
            $data['paragraphSpacingBefore'] = $this->paragraphSpacingBefore;
        }
        if (isset($this->strikethrough)) {
            $data['strikethrough'] =
                $this->strikethrough instanceof Arrayable
                    ? $this->strikethrough->toArray()
                    : $this->strikethrough;
        }
        if (isset($this->stroke)) {
            $data['stroke'] =
                $this->stroke instanceof Arrayable
                    ? $this->stroke->toArray()
                    : $this->stroke;
        }
        if (isset($this->textAlignment)) {
            $data['textAlignment'] = $this->textAlignment;
        }
        if (isset($this->textColor)) {
            $data['textColor'] =
                $this->textColor instanceof Arrayable
                    ? $this->textColor->toArray()
                    : $this->textColor;
        }
        if (isset($this->textShadow)) {
            $data['textShadow'] =
                $this->textShadow instanceof Arrayable
                    ? $this->textShadow->toArray()
                    : $this->textShadow;
        }
        if (isset($this->textTransform)) {
            $data['textTransform'] = $this->textTransform;
        }
        if (isset($this->tracking)) {
            $data['tracking'] = $this->tracking;
        }
        if (isset($this->underline)) {
            $data['underline'] =
                $this->underline instanceof Arrayable
                    ? $this->underline->toArray()
                    : $this->underline;
        }
        if (isset($this->unorderedListItems)) {
            $data['unorderedListItems'] =
                $this->unorderedListItems instanceof Arrayable
                    ? $this->unorderedListItems->toArray()
                    : $this->unorderedListItems;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        return $data;
    }
}
