<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all text component types.
 *
 * @see https://developer.apple.com/documentation/apple_news/text
 */
class Text extends Component
{
    /**
     * An array of Link objects that provide additional information for
     * ranges of text in the text property.
     * @var Format\Addition[]
     */
    protected $additions;

    /**
     * The formatting or markup method applied to the text.
     * @var string
     */
    protected $format;

    /**
     * An array of InlineTextStyle objects you can use to apply different
     * text styles to ranges of text. For each InlineTextStyle, you should
     * supply a rangeStart, rangeLength, and either a text style or the
     * identifier of a text style that is defined at the top level of the
     * document.
     * @var Format\InlineTextStyle[]
     */
    protected $inlineTextStyles;

    /**
     * The role of a text component depends on the type of content it
     * contains. For example, a PullQuote should have a role of pullquote,
     * and for text in the article body, the role should be body. See
     * Component.
     * @var string
     */
    protected $role;

    /**
     * The text to display in the article, including any formatting tags
     * depending on the format property.
     * @var string
     */
    protected $text;

    /**
     * Either an inline ComponentTextStyle object that contains styling
     * information, or a string reference to a ComponentTextStyle object that
     * is defined at the top level of the document in the componentTextStyles
     * property in Article Document.Component Text Styles.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['additions'])) {
            $this->setAdditions($data['additions']);
        }

        if (isset($data['format'])) {
            $this->setFormat($data['format']);
        }

        if (isset($data['inlineTextStyles'])) {
            $this->setInlineTextStyles($data['inlineTextStyles']);
        }

        if (isset($data['role'])) {
            $this->setRole($data['role']);
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
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
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
     * Set the role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        Assert::string($role);

        $this->role = $role;
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
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        $data = parent::toArray();
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
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->text)) {
            $data['text'] = $this->text;
        }
        if (isset($this->textStyle)) {
            $data['textStyle'] = is_object($this->textStyle)
                ? $this->textStyle->toArray()
                : $this->textStyle;
        }
        return $data;
    }
}
