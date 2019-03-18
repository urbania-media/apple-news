<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the text style (font family, size, color, and
 * so on) that you can apply to ranges of text.
 *
 * @see https://developer.apple.com/documentation/apple_news/textstyle
 */
class TextStyle implements \JsonSerializable
{
    /**
     * The background color for text lines.
     * @var string
     */
    protected $backgroundColor;

    /**
     * The font family to use for text rendering, for example Gill Sans.
     * Using a combination of fontFamily, fontWeight, fontWidth and fontStyle
     * you can define the appearance of the text. News automatically selects
     * the appropriate font variant from the available variants in that
     * family.
     * @var string
     */
    protected $fontFamily;

    /**
     * Use fontName to refer to an explicit font variant’s PostScript name,
     * such as GillSans-Bold. Alternatively, you can use a combination of
     * fontFamily, fontWeight, fontWidth and/or fontStyle to have News
     * automatically select the appropriate variant depending on the text
     * formatting used.
     * @var string
     */
    protected $fontName;

    /**
     * The size of the font, in points. By default, the font size will be
     * inherited from a parent component or a default style. As a best
     * practice, try not to go below 16 points for body text. The fontSize
     * may be automatically resized for different device sizes or for iOS
     * devices with Larger Accessibility Sizes enabled
     * @var integer
     */
    protected $fontSize;

    /**
     * The font style to apply for the selected font. Available options are:
     * @var string
     */
    protected $fontStyle;

    /**
     * The font weight to apply for font selection. In addition to explicit
     * weights (named or numerical), lighter and bolder are available, to set
     * text in a lighter or bolder font as compared to its surrounding text.
     * @var integer|string
     */
    protected $fontWeight;

    /**
     * The font width for font selection (known in CSS as font-stretch).
     * Defines the width characteristics of a font variant between normal,
     * condensed and expanded. Some font families have separate families
     * assigned for different widths (for example, "Avenir Next" and "Avenir
     * Next Condensed"), so make sure that the fontFamily you select supports
     * the specified fontWidth. Available options are:
     * @var string
     */
    protected $fontWidth;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an orderedListItems definition to
     * configure how list items inside <ol> tags should be displayed.
     * @var \Urbania\AppleNews\Format\ListItemStyle
     */
    protected $orderedListItems;

    /**
     * The text strikethrough. Set strikethrough to true to use the text
     * color inherited from the textColor property as the strikethrough
     * color, or provide a text decoration definition with a different color.
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $strikethrough;

    /**
     * The stroke style for the text outline. By default, stroke will be
     * omitted.
     * @var \Urbania\AppleNews\Format\TextStrokeStyle
     */
    protected $stroke;

    /**
     * The text color.
     * @var string
     */
    protected $textColor;

    /**
     * The text shadow for this style.
     * @var \Urbania\AppleNews\Format\Shadow
     */
    protected $textShadow;

    /**
     * The amount of tracking (spacing between characters) in text, as a
     * percentage of the fontSize. The actual spacing between letters is
     * determined by combining information from the font and font size.
     * @var integer|float
     */
    protected $tracking;

    /**
     * The text underlining. This style can be used for links. Set underline
     * to true to use the text color as the underline color, or provide a
     * text decoration with a different color.
     * @var \Urbania\AppleNews\Format\TextDecoration|boolean
     */
    protected $underline;

    /**
     * An object for use with text components with HTML markup. You can
     * create text styles containing an unorderedListItems definition to
     * configure how list items inside <ul> tags should be displayed.
     * @var \Urbania\AppleNews\Format\ListItemStyle
     */
    protected $unorderedListItems;

    /**
     * The vertical alignment of the text. You can use this property for
     * superscripts and subscripts. Valid values:
     * @var string
     */
    protected $verticalAlignment;

    /**
     * The transform to apply to the text.
     * @var string
     */
    protected $textTransform;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
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

        if (isset($data['textTransform'])) {
            $this->setTextTransform($data['textTransform']);
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
        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
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
        if (is_object($orderedListItems)) {
            Assert::isInstanceOf($orderedListItems, ListItemStyle::class);
        } else {
            Assert::isArray($orderedListItems);
        }

        $this->orderedListItems = is_array($orderedListItems)
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
        if (is_object($strikethrough)) {
            Assert::isInstanceOf($strikethrough, TextDecoration::class);
        } elseif (!is_array($strikethrough)) {
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
        if (is_object($stroke)) {
            Assert::isInstanceOf($stroke, TextStrokeStyle::class);
        } else {
            Assert::isArray($stroke);
        }

        $this->stroke = is_array($stroke)
            ? new TextStrokeStyle($stroke)
            : $stroke;
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
        if (is_object($textShadow)) {
            Assert::isInstanceOf($textShadow, Shadow::class);
        } else {
            Assert::isArray($textShadow);
        }

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
        Assert::string($textTransform);

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
        if (is_object($underline)) {
            Assert::isInstanceOf($underline, TextDecoration::class);
        } elseif (!is_array($underline)) {
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
        if (is_object($unorderedListItems)) {
            Assert::isInstanceOf($unorderedListItems, ListItemStyle::class);
        } else {
            Assert::isArray($unorderedListItems);
        }

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
        Assert::string($verticalAlignment);

        $this->verticalAlignment = $verticalAlignment;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->backgroundColor)) {
            $data['backgroundColor'] = is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor;
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
            $data['orderedListItems'] = is_object($this->orderedListItems)
                ? $this->orderedListItems->toArray()
                : $this->orderedListItems;
        }
        if (isset($this->strikethrough)) {
            $data['strikethrough'] = is_object($this->strikethrough)
                ? $this->strikethrough->toArray()
                : $this->strikethrough;
        }
        if (isset($this->stroke)) {
            $data['stroke'] = is_object($this->stroke)
                ? $this->stroke->toArray()
                : $this->stroke;
        }
        if (isset($this->textColor)) {
            $data['textColor'] = is_object($this->textColor)
                ? $this->textColor->toArray()
                : $this->textColor;
        }
        if (isset($this->textShadow)) {
            $data['textShadow'] = is_object($this->textShadow)
                ? $this->textShadow->toArray()
                : $this->textShadow;
        }
        if (isset($this->tracking)) {
            $data['tracking'] = $this->tracking;
        }
        if (isset($this->underline)) {
            $data['underline'] = is_object($this->underline)
                ? $this->underline->toArray()
                : $this->underline;
        }
        if (isset($this->unorderedListItems)) {
            $data['unorderedListItems'] = is_object($this->unorderedListItems)
                ? $this->unorderedListItems->toArray()
                : $this->unorderedListItems;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        if (isset($this->textTransform)) {
            $data['textTransform'] = $this->textTransform;
        }
        return $data;
    }
}
