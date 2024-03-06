<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The component for adding the name of the author.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/author.json
 */
class Author extends Text
{
    /**
     * Always author for this component.
     * @var string
     */
    protected $role = 'author';

    /**
     * The text to display in the article, including any formatting tags
     * depending on the format property.
     * You can also use a subset of HTML tags or Markdown syntax by setting
     * format to html or markdown, respectively. See . Alternatively, you can
     * style ranges of text individually using the  object.
     * @var string
     */
    protected $text;

    /**
     * An array of all the additions that should be applied to ranges of the
     * component's text.
     * Additions are ignored when format is set to html or markdown.
     * @var Format\Addition[]
     */
    protected $additions;

    /**
     * An object that defines vertical alignment with another component.
     * @var \Urbania\AppleNews\Format\Anchor
     */
    protected $anchor;

    /**
     * An object that defines an animation to be applied to the component.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ComponentAnimation|none
     */
    protected $animation;

    /**
     * An object that defines behavior for a component, like  or .
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\Behavior|none
     */
    protected $behavior;

    /**
     * An instance or array of text components that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalText[]|\Urbania\AppleNews\Format\ConditionalText
     */
    protected $conditional;

    /**
     * The formatting or markup method applied to the text.
     * If format is set to html or markdown, neither Additions nor
     * InlineTextStyles are supported.
     * @var string
     */
    protected $format;

    /**
     * A Boolean value that determines whether the component is hidden.
     * @var boolean
     */
    protected $hidden;

    /**
     * An optional unique identifier for this component. If used, this
     * identifier must be unique across the entire document. You will need an
     * identifier for your component if you want to anchor other components
     * to it.
     * @var string
     */
    protected $identifier;

    /**
     * An array of InlineTextStyle objects that you can use to apply
     * different text styles to ranges of text. For each InlineTextStyle, you
     * should supply a rangeStart, a rangeLength, and either a TextStyle
     * object or the identifier of a TextStyle that is defined at the top
     * level of the document.
     * Inline text styles are ignored when format is set to markdown or html.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var Format\InlineTextStyle[]|none
     */
    protected $inlineTextStyles;

    /**
     * An inline ComponentLayout object that contains layout information, or
     * a string reference to a ComponentLayout object that is defined at the
     * top level of the document.
     * If layout is not defined, size and position are based on various
     * factors, such as the device type, the length of the content, and the
     * role of this component.
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * An inline ComponentStyle object that defines the appearance of this
     * component, or a string reference to a ComponentStyle object that is
     * defined at the top level of the document.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    protected $style;

    /**
     * An inline ComponentTextStyle object that contains styling information,
     * or a string reference to a ComponentTextStyle object that is defined
     * at the top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentTextStyle|string
     */
    protected $textStyle;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['text'])) {
            $this->setText($data['text']);
        }

        if (isset($data['additions'])) {
            $this->setAdditions($data['additions']);
        }

        if (isset($data['anchor'])) {
            $this->setAnchor($data['anchor']);
        }

        if (isset($data['animation'])) {
            $this->setAnimation($data['animation']);
        }

        if (isset($data['behavior'])) {
            $this->setBehavior($data['behavior']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['format'])) {
            $this->setFormat($data['format']);
        }

        if (isset($data['hidden'])) {
            $this->setHidden($data['hidden']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['inlineTextStyles'])) {
            $this->setInlineTextStyles($data['inlineTextStyles']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
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
            !is_null($this->additions) ? array_merge($this->additions, [$item]) : [$item]
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
            !is_null($this->additions) ? array_merge($this->additions, $items) : $items
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

        $this->additions = is_array($additions)
            ? array_reduce(
                array_keys($additions),
                function ($array, $key) use ($additions) {
                    $item = $additions[$key];
                    $array[$key] = Utils::isAssociativeArray($item) ? new Addition($item) : $item;
                    return $array;
                },
                []
            )
            : $additions;
        return $this;
    }

    /**
     * Get the anchor
     * @return \Urbania\AppleNews\Format\Anchor
     */
    public function getAnchor()
    {
        return $this->anchor;
    }

    /**
     * Set the anchor
     * @param \Urbania\AppleNews\Format\Anchor|array $anchor
     * @return $this
     */
    public function setAnchor($anchor)
    {
        if (is_null($anchor)) {
            $this->anchor = null;
            return $this;
        }

        Assert::isSdkObject($anchor, Anchor::class);

        $this->anchor = Utils::isAssociativeArray($anchor) ? new Anchor($anchor) : $anchor;
        return $this;
    }

    /**
     * Get the animation
     * @return \Urbania\AppleNews\Format\ComponentAnimation|none
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set the animation
     * @param \Urbania\AppleNews\Format\ComponentAnimation|array|none $animation
     * @return $this
     */
    public function setAnimation($animation)
    {
        if (is_null($animation)) {
            $this->animation = null;
            return $this;
        }

        if (is_object($animation) || Utils::isAssociativeArray($animation)) {
            Assert::isSdkObject($animation, ComponentAnimation::class);
        } else {
            Assert::eq($animation, 'none');
        }

        $this->animation = Utils::isAssociativeArray($animation)
            ? ComponentAnimation::createTyped($animation)
            : $animation;
        return $this;
    }

    /**
     * Get the behavior
     * @return \Urbania\AppleNews\Format\Behavior|none
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set the behavior
     * @param \Urbania\AppleNews\Format\Behavior|array|none $behavior
     * @return $this
     */
    public function setBehavior($behavior)
    {
        if (is_null($behavior)) {
            $this->behavior = null;
            return $this;
        }

        if (is_object($behavior) || Utils::isAssociativeArray($behavior)) {
            Assert::isSdkObject($behavior, Behavior::class);
        } else {
            Assert::eq($behavior, 'none');
        }

        $this->behavior = Utils::isAssociativeArray($behavior)
            ? Behavior::createTyped($behavior)
            : $behavior;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalText[]|\Urbania\AppleNews\Format\ConditionalText
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalText[]|\Urbania\AppleNews\Format\ConditionalText|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalText::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalText::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalText($conditional)
            : $conditional;
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

        Assert::oneOf($format, ['markdown', 'html', 'none']);

        $this->format = $format;
        return $this;
    }

    /**
     * Get the hidden
     * @return boolean
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Set the hidden
     * @param boolean $hidden
     * @return $this
     */
    public function setHidden($hidden)
    {
        if (is_null($hidden)) {
            $this->hidden = null;
            return $this;
        }

        Assert::boolean($hidden);

        $this->hidden = $hidden;
        return $this;
    }

    /**
     * Get the identifier
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set the identifier
     * @param string $identifier
     * @return $this
     */
    public function setIdentifier($identifier)
    {
        if (is_null($identifier)) {
            $this->identifier = null;
            return $this;
        }

        Assert::string($identifier);

        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get the inlineTextStyles
     * @return Format\InlineTextStyle[]|none
     */
    public function getInlineTextStyles()
    {
        return $this->inlineTextStyles;
    }

    /**
     * Set the inlineTextStyles
     * @param Format\InlineTextStyle[]|none $inlineTextStyles
     * @return $this
     */
    public function setInlineTextStyles($inlineTextStyles)
    {
        if (is_null($inlineTextStyles)) {
            $this->inlineTextStyles = null;
            return $this;
        }

        if (is_array($inlineTextStyles)) {
            Assert::isArray($inlineTextStyles);
            Assert::allIsSdkObject($inlineTextStyles, InlineTextStyle::class);
        } else {
            Assert::eq($inlineTextStyles, 'none');
        }

        $this->inlineTextStyles = is_array($inlineTextStyles)
            ? array_reduce(
                array_keys($inlineTextStyles),
                function ($array, $key) use ($inlineTextStyles) {
                    $item = $inlineTextStyles[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new InlineTextStyle($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $inlineTextStyles;
        return $this;
    }

    /**
     * Get the layout
     * @return \Urbania\AppleNews\Format\ComponentLayout|string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\ComponentLayout|array|string $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_null($layout)) {
            $this->layout = null;
            return $this;
        }

        if (is_object($layout) || Utils::isAssociativeArray($layout)) {
            Assert::isSdkObject($layout, ComponentLayout::class);
        } else {
            Assert::string($layout);
        }

        $this->layout = Utils::isAssociativeArray($layout) ? new ComponentLayout($layout) : $layout;
        return $this;
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
     * Get the style
     * @return \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the style
     * @param \Urbania\AppleNews\Format\ComponentStyle|array|string|none $style
     * @return $this
     */
    public function setStyle($style)
    {
        if (is_null($style)) {
            $this->style = null;
            return $this;
        }

        if (is_object($style) || Utils::isAssociativeArray($style)) {
            Assert::isSdkObject($style, ComponentStyle::class);
        } else {
            Assert::string($style);
        }

        $this->style = Utils::isAssociativeArray($style) ? new ComponentStyle($style) : $style;
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

        if (is_object($textStyle) || Utils::isAssociativeArray($textStyle)) {
            Assert::isSdkObject($textStyle, ComponentTextStyle::class);
        } else {
            Assert::string($textStyle);
        }

        $this->textStyle = Utils::isAssociativeArray($textStyle)
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
        $data = parent::toArray();
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->text)) {
            $data['text'] = $this->text;
        }
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
        if (isset($this->anchor)) {
            $data['anchor'] =
                $this->anchor instanceof Arrayable ? $this->anchor->toArray() : $this->anchor;
        }
        if (isset($this->animation)) {
            $data['animation'] =
                $this->animation instanceof Arrayable
                    ? $this->animation->toArray()
                    : $this->animation;
        }
        if (isset($this->behavior)) {
            $data['behavior'] =
                $this->behavior instanceof Arrayable ? $this->behavior->toArray() : $this->behavior;
        }
        if (isset($this->conditional)) {
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
                    : $this->conditional;
        }
        if (isset($this->format)) {
            $data['format'] = $this->format;
        }
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->inlineTextStyles)) {
            $data['inlineTextStyles'] = $this->inlineTextStyles;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
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
