<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object used in image components for displaying captions when the
 * image is full-screen.
 *
 * @see https://developer.apple.com/documentation/apple_news/captiondescriptor
 */
class CaptionDescriptor extends BaseSdkObject
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
     * Add an item to additions
     * @param \Urbania\AppleNews\Format\Addition|array $item
     * @return $this
     */
    public function addAddition($item)
    {
        return $this->setAdditions(
            !is_null($this->additions)
                ? array_merge($this->additions, [$item])
                : [$item]
        );
    }

    /**
     * Add items to additions
     * @param array $items
     * @return $this
     */
    public function addAdditions($items)
    {
        Assert::isArray($items);
        return $this->setAdditions(
            !is_null($this->additions)
                ? array_merge($this->additions, $items)
                : $items
        );
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
     * Set the additions
     * @param Format\Addition[] $additions
     * @return $this
     */
    public function setAdditions($additions)
    {
        if (is_null($additions)) {
            $this->additions = null;
            return $this;
        }

        Assert::isArray($additions);
        Assert::allIsSdkObject($additions, Addition::class);

        $items = [];
        foreach ($additions as $key => $item) {
            $items[$key] = is_array($item) ? new Addition($item) : $item;
        }
        $this->additions = $items;
        return $this;
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
     * Set the format
     * @param string $format
     * @return $this
     */
    public function setFormat($format)
    {
        if (is_null($format)) {
            $this->format = null;
            return $this;
        }

        Assert::oneOf($format, ["markdown", "html", "none"]);

        $this->format = $format;
        return $this;
    }

    /**
     * Add an item to inlineTextStyles
     * @param \Urbania\AppleNews\Format\InlineTextStyle|array $item
     * @return $this
     */
    public function addInlineTextStyle($item)
    {
        return $this->setInlineTextStyles(
            !is_null($this->inlineTextStyles)
                ? array_merge($this->inlineTextStyles, [$item])
                : [$item]
        );
    }

    /**
     * Add items to inlineTextStyles
     * @param array $items
     * @return $this
     */
    public function addInlineTextStyles($items)
    {
        Assert::isArray($items);
        return $this->setInlineTextStyles(
            !is_null($this->inlineTextStyles)
                ? array_merge($this->inlineTextStyles, $items)
                : $items
        );
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
     * Set the inlineTextStyles
     * @param Format\InlineTextStyle[] $inlineTextStyles
     * @return $this
     */
    public function setInlineTextStyles($inlineTextStyles)
    {
        if (is_null($inlineTextStyles)) {
            $this->inlineTextStyles = null;
            return $this;
        }

        Assert::isArray($inlineTextStyles);
        Assert::allIsSdkObject($inlineTextStyles, InlineTextStyle::class);

        $items = [];
        foreach ($inlineTextStyles as $key => $item) {
            $items[$key] = is_array($item) ? new InlineTextStyle($item) : $item;
        }
        $this->inlineTextStyles = $items;
        return $this;
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
     * Get the textStyle
     * @return \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    public function getTextStyle()
    {
        return $this->textStyle;
    }

    /**
     * Set the textStyle
     * @param \Urbania\AppleNews\Format\ComponentTextStyle|array|string $textStyle
     * @return $this
     */
    public function setTextStyle($textStyle)
    {
        if (is_null($textStyle)) {
            $this->textStyle = null;
            return $this;
        }

        if (is_object($textStyle)) {
            Assert::isSdkObject($textStyle, ComponentTextStyle::class);
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
        $data = [];
        if (isset($this->additions)) {
            $data['additions'] = !is_null($this->additions)
                ? array_reduce(
                    array_keys($this->additions),
                    function ($items, $key) {
                        $items[$key] =
                            $this->additions[$key] instanceof Arrayable
                                ? $this->additions[$key]->toArray()
                                : $this->additions[$key];
                        return $items;
                    },
                    []
                )
                : $this->additions;
        }
        if (isset($this->format)) {
            $data['format'] = $this->format;
        }
        if (isset($this->inlineTextStyles)) {
            $data['inlineTextStyles'] = !is_null($this->inlineTextStyles)
                ? array_reduce(
                    array_keys($this->inlineTextStyles),
                    function ($items, $key) {
                        $items[$key] =
                            $this->inlineTextStyles[$key] instanceof Arrayable
                                ? $this->inlineTextStyles[$key]->toArray()
                                : $this->inlineTextStyles[$key];
                        return $items;
                    },
                    []
                )
                : $this->inlineTextStyles;
        }
        if (isset($this->text)) {
            $data['text'] = $this->text;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] =
                $this->textStyle instanceof Arrayable
                    ? $this->textStyle->toArray()
                    : $this->textStyle;
        }
        return $data;
    }
}
