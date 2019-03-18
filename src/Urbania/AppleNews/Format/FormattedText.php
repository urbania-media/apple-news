<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for specifying formatted text content and styling for
 * captions in table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/formattedtext
 */
class FormattedText implements \JsonSerializable
{
    /**
     * An array of Addition objects that supply additional information for
     * ranges of text in the text property.
     * @var Format\Addition[]
     */
    protected $additions;

    /**
     * The formatting or markup method applied to the text. If format is set
     * to html, neither additions nor inlineTextStyles is supported.
     * @var string
     */
    protected $format;

    /**
     * An array specifying ranges of characters and a TextStyle object to
     * apply to each range.
     * @var Format\InlineTextStyle[]
     */
    protected $inlineTextStyles;

    /**
     * The text, including any HTML tags.
     * @var string
     */
    protected $text;

    /**
     * Either a component TextStyle object, or the name string of one of your
     * styles in the ArticleDocument.componentTextStyles object.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    /**
     * The type must be formatted_text.
     * @var string
     */
    protected $type = 'formatted_text';

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
        Assert::oneOf($format, ["html", "none"]);

        $this->format = $format;
        return $this;
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
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
        if (isset($this->additions)) {
            $data['additions'] = !is_null($this->additions)
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
                        $items[$key] = is_object($this->inlineTextStyles[$key])
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
            $data['textStyle'] = is_object($this->textStyle)
                ? $this->textStyle->toArray()
                : $this->textStyle;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
