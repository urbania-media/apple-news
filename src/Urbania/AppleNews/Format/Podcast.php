<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The component for adding a Podcast show or episode.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/podcast.json
 */
class Podcast extends Component
{
    /**
     * Always podcast for this component.
     * @var string
     */
    protected $role = 'podcast';

    /**
     * The URL of the podcast show or episode you want to embed. The show or
     * episode must be available on Apple Podcasts. Note that a user cannot
     * play the show or episode directly in the article. For more
     * information, see .
     * The URL determines whether it is a show or an episode.
     *  The following is an example of a podcast show link:
     * https://podcasts.apple.com/us/podcast/apple-events/id1473854035
     * The following is an example of a podcast episode link:
     * https://podcasts.apple.com/us/podcast/apple-events/id1473854035?i=1000479125753
     * @var string
     */
    protected $URL;

    /**
     * An object that defines vertical alignment with another component.
     * @var \Urbania\AppleNews\Format\Anchor
     */
    protected $anchor;

    /**
     * An object that defines an animation to apply to the component.
     * The none value is for conditional design elements. Adding it here has
     * no effect.
     * @var \Urbania\AppleNews\Format\ComponentAnimation|none
     */
    protected $animation;

    /**
     * An object that defines behavior for a component, like  or .
     * The none value is for conditional design elements. Adding it here has
     * no effect.
     * @var \Urbania\AppleNews\Format\Behavior|none
     */
    protected $behavior;

    /**
     * An instance or array of component properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalComponent[]|\Urbania\AppleNews\Format\ConditionalComponent
     */
    protected $conditional;

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
     * An inline ComponentLayout object that contains layout information, or
     * a string reference to a ComponentLayout object that is defined at the
     * top level of the document.
     * If layout is not defined, size and position will be based on various
     * factors, such as the device type, the length of the content, and the
     * role of this component.
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * The viewport layout of the component.
     * Valid values:
     * @var string
     */
    protected $orientation;

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
     * The color theme of the component.
     * Valid Values:
     * @var string
     */
    protected $theme;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
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

        if (isset($data['hidden'])) {
            $this->setHidden($data['hidden']);
        }

        if (isset($data['identifier'])) {
            $this->setIdentifier($data['identifier']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }

        if (isset($data['orientation'])) {
            $this->setOrientation($data['orientation']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }

        if (isset($data['theme'])) {
            $this->setTheme($data['theme']);
        }
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
     * Get the orientation
     * @return string
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set the orientation
     * @param string $orientation
     * @return $this
     */
    public function setOrientation($orientation)
    {
        if (is_null($orientation)) {
            $this->orientation = null;
            return $this;
        }

        Assert::oneOf($orientation, ['horizontal', 'automatic']);

        $this->orientation = $orientation;
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
     * Get the theme
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set the theme
     * @param string $theme
     * @return $this
     */
    public function setTheme($theme)
    {
        if (is_null($theme)) {
            $this->theme = null;
            return $this;
        }

        Assert::oneOf($theme, ['light', 'dark', 'automatic']);

        $this->theme = $theme;
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
        Assert::uri($URL);

        $this->URL = $URL;
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
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
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
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        if (isset($this->orientation)) {
            $data['orientation'] = $this->orientation;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
        }
        if (isset($this->theme)) {
            $data['theme'] = $this->theme;
        }
        return $data;
    }
}
