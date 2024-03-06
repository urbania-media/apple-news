<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the text style (font family, size, color, and
 * so on) that you can apply to ranges of text.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/textstyle.json
 */
class TextStyle extends BaseSdkObject
{
    /**
     * The background color for text lines. The value defaults to
     * transparent.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var string|none
     */
    protected $backgroundColor;

    /**
     * An instance or array of text style properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalTextStyle[]|\Urbania\AppleNews\Format\ConditionalTextStyle
     */
    protected $conditional;

    /**
     * The font family to use for text rendering, for example Gill Sans.
     * Using a combination of fontFamily, fontWeight, fontWidth and
     * fontStyle, you can define the appearance of the text. News
     * automatically selects the appropriate font variant from the available
     * variants in that family.
     * See .
     * @var string|string
     */
    protected $fontFamily;

    /**
     * The fontName to refer to an explicit font variant’s PostScript name,
     * such as GillSans-Bold. Alternatively, you can use a combination of
     * fontFamily, fontWeight, fontWidth and/or fontStyle to have News
     * automatically select the appropriate variant depending on the text
     * formatting used.
     * See .
     * @var string
     */
    protected $fontName;

    /**
     * The size of the font, in points. By default, the font size is
     * inherited from a parent component or a default style. As a best
     * practice, try not to go below 16 points for body text. The fontSize
     * may be automatically resized for different device sizes or for iOS and
     * iPadOS devices with Larger Accessibility Sizes enabled.
     * @var integer
     */
    protected $fontSize;

    /**
     * The font style to apply for the selected font.
     * Valid values:
     * @var string
     */
    protected $fontStyle;

    /**
     * The font weight to apply for font selection. In addition to explicit
     * weights (named or numerical), lighter and bolder are available, to set
     * text in a lighter or bolder font as compared to its surrounding text.
     * If a font variant with the given specifications cannot be found in the
     * provided font family, the system selects an alternative that has the
     * closest match. If no bold/bolder font is found, News doesn't create a
     * bold alternative, but falls back to the closest match. Similarly, if
     * there's no italic or oblique font variant, the system won't slant text
     * to make text appear italicized.
     * Valid values:
     * @var integer|string
     */
    protected $fontWeight;

    /**
     * The font width for font selection (known in CSS as font-stretch).
     * Defines the width characteristics of a font variant between normal,
     * condensed, and expanded. Some font families have separate families
     * assigned for different widths (for example, Avenir Next and Avenir
     * Next Condensed), so make sure that the fontFamily you select supports
     * the specified fontWidth.
     * Valid values:
     * @var string
     */
    protected $fontWidth;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an orderedListItems definition to
     * configure how list items inside <ol> tags should be displayed.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ListItemStyle|none
     */
    protected $orderedListItems;

    /**
     * The text strikethrough. Set strikethrough to true to use the text
     * color inherited from the textColor property as the strikethrough
     * color, or provide a text decoration definition with a different color.
     * By default strikethrough is omitted (false).
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $strikethrough;

    /**
     * The stroke style for the text outline. By default, stroke is  omitted.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\TextStrokeStyle|none
     */
    protected $stroke;

    /**
     * The text color.
     * @var string
     */
    protected $textColor;

    /**
     * The text shadow for this style.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\TextShadow|none
     */
    protected $textShadow;

    /**
     * The transform to apply to the text.
     * Valid values:
     * @var string
     */
    protected $textTransform;

    /**
     * The amount of tracking (spacing between characters) in text, as a
     * percentage of the fontSize. The actual spacing between letters is
     * determined by combining information from the font and font size.
     * Example: Set tracking to 0.5 to make the distance between characters
     * increase by 50 percent of the fontSize. With a font size of 10, the
     * additional space between characters is 5 points.
     * @var integer|float
     */
    protected $tracking;

    /**
     * The text underlining. This style can be used for links. Set underline
     * to true to use the text color as the underline color, or provide a
     * text decoration with a different color. By default underline is
     * omitted (false).
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $underline;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an unorderedListItems definition to
     * configure how list items inside <ul> tags should be displayed.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ListItemStyle|none
     */
    protected $unorderedListItems;

    /**
     * The vertical alignment of the text. You can use this property for
     * superscripts and subscripts.
     * Overrides values specified in parent text styles.
     * Default value: baseline when unspecified, or the value specified in a
     * TextStyle object applied to the same range.
     * The values superscript and subscript also adjust the font size to
     * two-thirds of the size defined for that character range.
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
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

        if (isset($data['orderedListItems'])) {
            $this->setOrderedListItems($data['orderedListItems']);
        }

        if (isset($data['strikethrough'])) {
            $this->setStrikethrough($data['strikethrough']);
        }

        if (isset($data['stroke'])) {
            $this->setStroke($data['stroke']);
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
     * @return string|none
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string|none $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        if (is_null($backgroundColor)) {
            $this->backgroundColor = null;
            return $this;
        }

        if ($backgroundColor !== 'none') {
            Assert::isColor($backgroundColor);
        }

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalTextStyle[]|\Urbania\AppleNews\Format\ConditionalTextStyle
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalTextStyle[]|\Urbania\AppleNews\Format\ConditionalTextStyle|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalTextStyle::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalTextStyle::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalTextStyle($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the fontFamily
     * @return string|string
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * Set the fontFamily
     * @param string|string $fontFamily
     * @return $this
     */
    public function setFontFamily($fontFamily)
    {
        if (is_null($fontFamily)) {
            $this->fontFamily = null;
            return $this;
        }

        Assert::oneOf($fontFamily, ['system']);

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

        Assert::oneOf($fontStyle, ['normal', 'italic', 'oblique']);

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
            'thin',
            'extra-light',
            'extralight',
            'ultra-light',
            'light',
            'regular',
            'normal',
            'book',
            'roman',
            'medium',
            'semi-bold',
            'semibold',
            'demi-bold',
            'demibold',
            'bold',
            'extra-bold',
            'extrabold',
            'ultra-bold',
            'ultrabold',
            'black',
            'heavy',
            'lighter',
            'bolder',
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
            'ultra-compressed',
            'extra-compressed',
            'compressed',
            'ultra-condensed',
            'extra-condensed',
            'condensed',
            'semi-condensed',
            'normal',
            'semi-expanded',
            'expanded',
            'extra-expanded',
            'ultra-expanded',
        ]);

        $this->fontWidth = $fontWidth;
        return $this;
    }

    /**
     * Get the orderedListItems
     * @return \Urbania\AppleNews\Format\ListItemStyle|none
     */
    public function getOrderedListItems()
    {
        return $this->orderedListItems;
    }

    /**
     * Set the orderedListItems
     * @param \Urbania\AppleNews\Format\ListItemStyle|array|none $orderedListItems
     * @return $this
     */
    public function setOrderedListItems($orderedListItems)
    {
        if (is_null($orderedListItems)) {
            $this->orderedListItems = null;
            return $this;
        }

        if (is_object($orderedListItems) || Utils::isAssociativeArray($orderedListItems)) {
            Assert::isSdkObject($orderedListItems, ListItemStyle::class);
        } else {
            Assert::eq($orderedListItems, 'none');
        }

        $this->orderedListItems = Utils::isAssociativeArray($orderedListItems)
            ? new ListItemStyle($orderedListItems)
            : $orderedListItems;
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

        if (is_object($strikethrough) || Utils::isAssociativeArray($strikethrough)) {
            Assert::isSdkObject($strikethrough, TextDecoration::class);
        } else {
            Assert::boolean($strikethrough);
        }

        $this->strikethrough = Utils::isAssociativeArray($strikethrough)
            ? new TextDecoration($strikethrough)
            : $strikethrough;
        return $this;
    }

    /**
     * Get the stroke
     * @return \Urbania\AppleNews\Format\TextStrokeStyle|none
     */
    public function getStroke()
    {
        return $this->stroke;
    }

    /**
     * Set the stroke
     * @param \Urbania\AppleNews\Format\TextStrokeStyle|array|none $stroke
     * @return $this
     */
    public function setStroke($stroke)
    {
        if (is_null($stroke)) {
            $this->stroke = null;
            return $this;
        }

        if (is_object($stroke) || Utils::isAssociativeArray($stroke)) {
            Assert::isSdkObject($stroke, TextStrokeStyle::class);
        } else {
            Assert::eq($stroke, 'none');
        }

        $this->stroke = Utils::isAssociativeArray($stroke) ? new TextStrokeStyle($stroke) : $stroke;
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
     * @return \Urbania\AppleNews\Format\TextShadow|none
     */
    public function getTextShadow()
    {
        return $this->textShadow;
    }

    /**
     * Set the textShadow
     * @param \Urbania\AppleNews\Format\TextShadow|array|none $textShadow
     * @return $this
     */
    public function setTextShadow($textShadow)
    {
        if (is_null($textShadow)) {
            $this->textShadow = null;
            return $this;
        }

        if (is_object($textShadow) || Utils::isAssociativeArray($textShadow)) {
            Assert::isSdkObject($textShadow, TextShadow::class);
        } else {
            Assert::eq($textShadow, 'none');
        }

        $this->textShadow = Utils::isAssociativeArray($textShadow)
            ? new TextShadow($textShadow)
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
            'uppercase',
            'lowercase',
            'capitalize',
            'smallcaps',
            'none',
        ]);

        $this->textTransform = $textTransform;
        return $this;
    }

    /**
     * Get the tracking
     * @return integer|float
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * Set the tracking
     * @param integer|float $tracking
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

        if (is_object($underline) || Utils::isAssociativeArray($underline)) {
            Assert::isSdkObject($underline, TextDecoration::class);
        } else {
            Assert::boolean($underline);
        }

        $this->underline = Utils::isAssociativeArray($underline)
            ? new TextDecoration($underline)
            : $underline;
        return $this;
    }

    /**
     * Get the unorderedListItems
     * @return \Urbania\AppleNews\Format\ListItemStyle|none
     */
    public function getUnorderedListItems()
    {
        return $this->unorderedListItems;
    }

    /**
     * Set the unorderedListItems
     * @param \Urbania\AppleNews\Format\ListItemStyle|array|none $unorderedListItems
     * @return $this
     */
    public function setUnorderedListItems($unorderedListItems)
    {
        if (is_null($unorderedListItems)) {
            $this->unorderedListItems = null;
            return $this;
        }

        if (is_object($unorderedListItems) || Utils::isAssociativeArray($unorderedListItems)) {
            Assert::isSdkObject($unorderedListItems, ListItemStyle::class);
        } else {
            Assert::eq($unorderedListItems, 'none');
        }

        $this->unorderedListItems = Utils::isAssociativeArray($unorderedListItems)
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

        Assert::oneOf($verticalAlignment, ['superscript', 'subscript', 'baseline']);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] =
                $this->backgroundColor instanceof Arrayable
                    ? $this->backgroundColor->toArray()
                    : $this->backgroundColor;
        }
        if (isset($this->conditional)) {
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
                    : $this->conditional;
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
        if (isset($this->orderedListItems)) {
            $data['orderedListItems'] =
                $this->orderedListItems instanceof Arrayable
                    ? $this->orderedListItems->toArray()
                    : $this->orderedListItems;
        }
        if (isset($this->strikethrough)) {
            $data['strikethrough'] =
                $this->strikethrough instanceof Arrayable
                    ? $this->strikethrough->toArray()
                    : $this->strikethrough;
        }
        if (isset($this->stroke)) {
            $data['stroke'] =
                $this->stroke instanceof Arrayable ? $this->stroke->toArray() : $this->stroke;
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
