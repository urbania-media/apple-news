<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object used in image components for displaying captions when the
 * image is full-screen.
 *
 * @see https://developer.apple.com/documentation/apple_news/captiondescriptor
 */
class CaptionDescriptor
{
    /**
     * An array of Link objects that provide additional information for
     * ranges of the caption text in the text property.
     * @var Format\Addition[]
     */
    protected $additions;

    /**
     * The formatting or markup method applied to the text.
     * @var string
     */
    protected $format;

    /**
     * Array of InlineTextStyle objects to be applied to ranges of the
     * caption’s text.
     * @var Format\InlineTextStyle[]
     */
    protected $inlineTextStyles;

    /**
     * The text to display in the caption, including any formatting tags or
     * markup, depending on the format property.
     * @var string
     */
    protected $text;

    /**
     * Either an inline ComponentTextStyle object that contains styling
     * information, or a string reference to a component text style object
     * that is defined in Article Document.componentText Styles.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    public function __construct(array $data = [])
    {
        if (isset($data['additions'])) {
            $this->setAdditions($data['additions']);
        }

        if (isset($data['format'])) {
            $this->setFormat($data['format']);
        }

        if (isset($data['inlineTextStyles'])) {
            $this->setInlineTextStyles($data['inlineTextStyles']);
        }

        if (isset($data['text'])) {
            $this->setText($data['text']);
        }

        if (isset($data['textStyle'])) {
            $this->setTextStyle($data['textStyle']);
        }
    }

    /**
     * Get the additions
     * @return Format\Addition[]
     */
    public function getAdditions()
    {
        return $this->additions;
    }

    /**
     * Get the format
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Get the inlineTextStyles
     * @return Format\InlineTextStyle[]
     */
    public function getInlineTextStyles()
    {
        return $this->inlineTextStyles;
    }

    /**
     * Get the text
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the textStyle
     * @return \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    public function getTextStyle()
    {
        return $this->textStyle;
    }

    /**
     * Set the additions
     * @param Format\Addition[] $additions
     * @return $this
     */
    public function setAdditions($additions)
    {
        Assert::isArray($additions);
        Assert::allIsInstanceOfOrArray($additions, Addition::class);

        $items = [];
        foreach ($additions as $key => $item) {
            $items[$key] = is_array($item) ? new Addition($item) : $item;
        }
        $this->additions = $items;
        return $this;
    }

    /**
     * Set the format
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        Assert::oneOf($format, ["markdown", "html", "none"]);

        $this->format = $format;
        return $this;
    }

    /**
     * Set the inlineTextStyles
     * @param Format\InlineTextStyle[] $inlineTextStyles
     * @return $this
     */
    public function setInlineTextStyles($inlineTextStyles)
    {
        Assert::isArray($inlineTextStyles);
        Assert::allIsInstanceOfOrArray(
            $inlineTextStyles,
            InlineTextStyle::class
        );

        $items = [];
        foreach ($inlineTextStyles as $key => $item) {
            $items[$key] = is_array($item) ? new InlineTextStyle($item) : $item;
        }
        $this->inlineTextStyles = $items;
        return $this;
    }

    /**
     * Set the text
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        Assert::string($text);

        $this->text = $text;
        return $this;
    }

    /**
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\ComponentTextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_object($textStyle)) {
            Assert::isInstanceOf($textStyle, ComponentTextStyle::class);
        } elseif (!is_array($textStyle)) {
            Assert::string($textStyle);
        }

        $this->textStyle = is_array($textStyle)
            ? new ComponentTextStyle($textStyle)
            : $textStyle;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'additions' => !is_null($this->additions)
                ? array_reduce(
                    array_keys($this->additions),
                    function ($items, $key) {
                        $items[$key] = is_object($this->additions[$key])
                            ? $this->additions[$key]->toArray()
                            : $this->additions[$key];
                        return $items;
                    },
                    []
                )
                : $this->additions,
            'format' => $this->format,
            'inlineTextStyles' => !is_null($this->inlineTextStyles)
                ? array_reduce(
                    array_keys($this->inlineTextStyles),
                    function ($items, $key) {
                        $items[$key] = is_object($this->inlineTextStyles[$key])
                            ? $this->inlineTextStyles[$key]->toArray()
                            : $this->inlineTextStyles[$key];
                        return $items;
                    },
                    []
                )
                : $this->inlineTextStyles,
            'text' => $this->text,
            'textStyle' => is_object($this->textStyle)
                ? $this->textStyle->toArray()
                : $this->textStyle
        ];
    }
}
