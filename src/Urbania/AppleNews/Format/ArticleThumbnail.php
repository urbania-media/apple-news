<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The component for displaying a thumbnail image with an article link.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articlethumbnail.json
 */
class ArticleThumbnail extends Component
{
    /**
     * Always article_thumbnail for this component.
     * @var string
     */
    protected $role = 'article_thumbnail';

    /**
     * A caption that describes the image. The text is used for VoiceOver.
     * For more information about VoiceOver, see the  page in Accessibility.
     * If accessibilityCaption is not provided, the caption value is used for
     * VoiceOver for iOS, VoiceOver for iPadOS, and VoiceOver for macOS.
     * @var string
     */
    protected $accessibilityCaption;

    /**
     * Ignored for all children of .
     * @var Format\ComponentLink[]
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
     * The identifier of the article that this component displays the
     * thumbnail of. By default the articleIdentifier value is inherited from
     * the parent  component.
     * @var string
     */
    protected $articleIdentifier;

    /**
     * The aspect ratio of the component in which the article thumbnail is
     * displayed.
     * @var float
     */
    protected $aspectRatio;

    /**
     * An object that defines behavior for a component, like  or .
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\Behavior|none
     */
    protected $behavior;

    /**
     * A caption that describes the image. The article displays this text
     * when the image is full screen, and VoiceOver uses this text if you
     * don’t provide accessibilityCaption text. For more information about
     * VoiceOver, see the  page in Accessibility. The caption text doesn’t
     * appear in the main article view. To display a caption in the main
     * article view, use the  component.
     * @var \Urbania\AppleNews\Format\CaptionDescriptor|string
     */
    protected $caption;

    /**
     * An instance or array of component properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalComponent[]|\Urbania\AppleNews\Format\ConditionalComponent
     */
    protected $conditional;

    /**
     * A Boolean that indicates that the image may contain explicit content.
     * @var boolean
     */
    protected $explicitContent;

    /**
     * A string that indicates how to display the image fill.
     * Valid values:
     * @var string
     */
    protected $fillMode;

    /**
     * A Boolean that indicates whether the component is hidden.
     * @var boolean
     */
    protected $hidden;

    /**
     * A string that sets the horizontal alignment of the image fill within
     * its component.
     * Valid values:
     * You can use fillMode with horizontalAlignment to achieve the effect
     * you want. For example, set fillMode to fit and horizontalAlignment to
     * left to fit the image based on its aspect ratio and align the left
     * edge of the fill with the left edge of the component. Or set fillMode
     * to cover and horizontalAlignment to right to scale the image
     * horizontally and align the right edge of the fill with the right edge
     * of the component.
     * @var string
     */
    protected $horizontalAlignment;

    /**
     * A unique identifier for this component. If used, the identifier must
     * be unique across the entire document. An identifier is required if you
     * want to anchor other components to this component. See .
     * @var string
     */
    protected $identifier;

    /**
     * An inline ComponentLayout object that contains layout information, or
     * a string reference to a ComponentLayout object that is defined at the
     * top level of the document.
     *  If layout is not defined, size and position are based on various
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
     * The URL of an image file.
     * If omitted, the thumbnail of the article referenced in the  component
     * is used. Images should be high-resolution so they can be smoothly
     * scaled down.
     * Image URLs can begin with http://, https://, or bundle://. If the
     * image URL begins with bundle://, the image file must be in the same
     * directory as the document.
     * Image filenames should be properly encoded as URLs.
     *  See .
     * @var string
     */
    protected $URL;

    /**
     * A string that defines the vertical alignment of the article thumbnail
     * within the component.
     * @var string
     */
    protected $verticalAlignment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
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

        if (isset($data['articleIdentifier'])) {
            $this->setArticleIdentifier($data['articleIdentifier']);
        }

        if (isset($data['aspectRatio'])) {
            $this->setAspectRatio($data['aspectRatio']);
        }

        if (isset($data['behavior'])) {
            $this->setBehavior($data['behavior']);
        }

        if (isset($data['caption'])) {
            $this->setCaption($data['caption']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['explicitContent'])) {
            $this->setExplicitContent($data['explicitContent']);
        }

        if (isset($data['fillMode'])) {
            $this->setFillMode($data['fillMode']);
        }

        if (isset($data['hidden'])) {
            $this->setHidden($data['hidden']);
        }

        if (isset($data['horizontalAlignment'])) {
            $this->setHorizontalAlignment($data['horizontalAlignment']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['verticalAlignment'])) {
            $this->setVerticalAlignment($data['verticalAlignment']);
        }
    }

    /**
     * Get the accessibilityCaption
     * @return string
     */
    public function getAccessibilityCaption()
    {
        return $this->accessibilityCaption;
    }

    /**
     * Set the accessibilityCaption
     * @param string $accessibilityCaption
     * @return $this
     */
    public function setAccessibilityCaption($accessibilityCaption)
    {
        if (is_null($accessibilityCaption)) {
            $this->accessibilityCaption = null;
            return $this;
        }

        Assert::string($accessibilityCaption);

        $this->accessibilityCaption = $accessibilityCaption;
        return $this;
    }

    /**
     * Add an item to additions
     * @param \Urbania\AppleNews\Format\ComponentLink|array $item
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
     * @return Format\ComponentLink[]
     */
    public function getAdditions()
    {
        return $this->additions;
    }

    /**
     * Set the additions
     * @param Format\ComponentLink[] $additions
     * @return $this
     */
    public function setAdditions($additions)
    {
        if (is_null($additions)) {
            $this->additions = null;
            return $this;
        }

        Assert::isArray($additions);
        Assert::allIsSdkObject($additions, ComponentLink::class);

        $this->additions = is_array($additions)
            ? array_reduce(
                array_keys($additions),
                function ($array, $key) use ($additions) {
                    $item = $additions[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new ComponentLink($item)
                        : $item;
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
     * Get the articleIdentifier
     * @return string
     */
    public function getArticleIdentifier()
    {
        return $this->articleIdentifier;
    }

    /**
     * Set the articleIdentifier
     * @param string $articleIdentifier
     * @return $this
     */
    public function setArticleIdentifier($articleIdentifier)
    {
        if (is_null($articleIdentifier)) {
            $this->articleIdentifier = null;
            return $this;
        }

        Assert::string($articleIdentifier);

        $this->articleIdentifier = $articleIdentifier;
        return $this;
    }

    /**
     * Get the aspectRatio
     * @return float
     */
    public function getAspectRatio()
    {
        return $this->aspectRatio;
    }

    /**
     * Set the aspectRatio
     * @param float $aspectRatio
     * @return $this
     */
    public function setAspectRatio($aspectRatio)
    {
        if (is_null($aspectRatio)) {
            $this->aspectRatio = null;
            return $this;
        }

        Assert::float($aspectRatio);

        $this->aspectRatio = $aspectRatio;
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
     * Get the caption
     * @return \Urbania\AppleNews\Format\CaptionDescriptor|string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption
     * @param \Urbania\AppleNews\Format\CaptionDescriptor|array|string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        if (is_null($caption)) {
            $this->caption = null;
            return $this;
        }

        if (is_object($caption) || Utils::isAssociativeArray($caption)) {
            Assert::isSdkObject($caption, CaptionDescriptor::class);
        } else {
            Assert::string($caption);
        }

        $this->caption = Utils::isAssociativeArray($caption)
            ? new CaptionDescriptor($caption)
            : $caption;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalComponent[]|\Urbania\AppleNews\Format\ConditionalComponent
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalComponent[]|\Urbania\AppleNews\Format\ConditionalComponent|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalComponent::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalComponent::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalComponent($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the explicitContent
     * @return boolean
     */
    public function getExplicitContent()
    {
        return $this->explicitContent;
    }

    /**
     * Set the explicitContent
     * @param boolean $explicitContent
     * @return $this
     */
    public function setExplicitContent($explicitContent)
    {
        if (is_null($explicitContent)) {
            $this->explicitContent = null;
            return $this;
        }

        Assert::boolean($explicitContent);

        $this->explicitContent = $explicitContent;
        return $this;
    }

    /**
     * Get the fillMode
     * @return string
     */
    public function getFillMode()
    {
        return $this->fillMode;
    }

    /**
     * Set the fillMode
     * @param string $fillMode
     * @return $this
     */
    public function setFillMode($fillMode)
    {
        if (is_null($fillMode)) {
            $this->fillMode = null;
            return $this;
        }

        Assert::oneOf($fillMode, ['cover', 'fit']);

        $this->fillMode = $fillMode;
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
     * Get the horizontalAlignment
     * @return string
     */
    public function getHorizontalAlignment()
    {
        return $this->horizontalAlignment;
    }

    /**
     * Set the horizontalAlignment
     * @param string $horizontalAlignment
     * @return $this
     */
    public function setHorizontalAlignment($horizontalAlignment)
    {
        if (is_null($horizontalAlignment)) {
            $this->horizontalAlignment = null;
            return $this;
        }

        Assert::oneOf($horizontalAlignment, ['left', 'center', 'right']);

        $this->horizontalAlignment = $horizontalAlignment;
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
     * Get the URL
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the URL
     * @param string $URL
     * @return $this
     */
    public function setURL($URL)
    {
        if (is_null($URL)) {
            $this->URL = null;
            return $this;
        }

        Assert::uri($URL);

        $this->URL = $URL;
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

        Assert::oneOf($verticalAlignment, ['top', 'center', 'bottom']);

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
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->accessibilityCaption)) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
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
        if (isset($this->articleIdentifier)) {
            $data['articleIdentifier'] = $this->articleIdentifier;
        }
        if (isset($this->aspectRatio)) {
            $data['aspectRatio'] = $this->aspectRatio;
        }
        if (isset($this->behavior)) {
            $data['behavior'] =
                $this->behavior instanceof Arrayable ? $this->behavior->toArray() : $this->behavior;
        }
        if (isset($this->caption)) {
            $data['caption'] =
                $this->caption instanceof Arrayable ? $this->caption->toArray() : $this->caption;
        }
        if (isset($this->conditional)) {
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
                    : $this->conditional;
        }
        if (isset($this->explicitContent)) {
            $data['explicitContent'] = $this->explicitContent;
        }
        if (isset($this->fillMode)) {
            $data['fillMode'] = $this->fillMode;
        }
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->horizontalAlignment)) {
            $data['horizontalAlignment'] = $this->horizontalAlignment;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
        }
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->verticalAlignment)) {
            $data['verticalAlignment'] = $this->verticalAlignment;
        }
        return $data;
    }
}
