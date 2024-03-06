<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The component for adding a map with a specific point of interest.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/place.json
 */
class Place extends Component
{
    /**
     * The latitude of the place’s location.
     * @var integer|float
     */
    protected $latitude;

    /**
     * The longitude of the place’s location.
     * @var integer|float
     */
    protected $longitude;

    /**
     * Always place for this component.
     * @var string
     */
    protected $role = 'place';

    /**
     * The caption that describes a place. The text is used for VoiceOver.
     * For more information about VoiceOver, see the  page in Accessibility.
     * If accessibilityCaption is not provided, the caption value is used for
     * VoiceOver for iOS, VoiceOver for iPadOS, and VoiceOver for macOS.
     * @var string
     */
    protected $accessibilityCaption;

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
     * A string that describes the place depicted on the map. For example, if
     * the latitude and longitude point to a park, the caption should contain
     * the name of the park. The caption is displayed in the full screen
     * version of the map, and the text is used by VoiceOver if
     * accessibilityCaption is not provided. For more information about
     * VoiceOver, see the  page in Accessibility.
     * @var string
     */
    protected $caption;

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
     * A string that defines the type of map to display by default.
     * Valid values:
     * @var string
     */
    protected $mapType;

    /**
     * The object for defining the visible area of a map, relative to its
     * center. A span is defined in deltas for latitude and longitude.
     * @var \Urbania\AppleNews\Format\MapSpan
     */
    protected $span;

    /**
     * An inline ComponentStyle object that defines the appearance of this
     * component, or a string reference to a ComponentStyle object that is
     * defined at the top level of the document.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    protected $style;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['latitude'])) {
            $this->setLatitude($data['latitude']);
        }

        if (isset($data['longitude'])) {
            $this->setLongitude($data['longitude']);
        }

        if (isset($data['accessibilityCaption'])) {
            $this->setAccessibilityCaption($data['accessibilityCaption']);
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

        if (isset($data['caption'])) {
            $this->setCaption($data['caption']);
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

        if (isset($data['mapType'])) {
            $this->setMapType($data['mapType']);
        }

        if (isset($data['span'])) {
            $this->setSpan($data['span']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
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
     * Get the caption
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption
     * @param string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        if (is_null($caption)) {
            $this->caption = null;
            return $this;
        }

        Assert::string($caption);

        $this->caption = $caption;
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
     * Get the latitude
     * @return integer|float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the latitude
     * @param integer|float $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        Assert::number($latitude);

        $this->latitude = $latitude;
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
     * Get the longitude
     * @return integer|float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the longitude
     * @param integer|float $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        Assert::number($longitude);

        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get the mapType
     * @return string
     */
    public function getMapType()
    {
        return $this->mapType;
    }

    /**
     * Set the mapType
     * @param string $mapType
     * @return $this
     */
    public function setMapType($mapType)
    {
        if (is_null($mapType)) {
            $this->mapType = null;
            return $this;
        }

        Assert::oneOf($mapType, ['standard', 'hybrid', 'satellite']);

        $this->mapType = $mapType;
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
     * Get the span
     * @return \Urbania\AppleNews\Format\MapSpan
     */
    public function getSpan()
    {
        return $this->span;
    }

    /**
     * Set the span
     * @param \Urbania\AppleNews\Format\MapSpan|array $span
     * @return $this
     */
    public function setSpan($span)
    {
        if (is_null($span)) {
            $this->span = null;
            return $this;
        }

        Assert::isSdkObject($span, MapSpan::class);

        $this->span = Utils::isAssociativeArray($span) ? new MapSpan($span) : $span;
        return $this;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->latitude)) {
            $data['latitude'] = $this->latitude;
        }
        if (isset($this->longitude)) {
            $data['longitude'] = $this->longitude;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->accessibilityCaption)) {
            $data['accessibilityCaption'] = $this->accessibilityCaption;
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
        if (isset($this->caption)) {
            $data['caption'] = $this->caption;
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
        if (isset($this->mapType)) {
            $data['mapType'] = $this->mapType;
        }
        if (isset($this->span)) {
            $data['span'] = $this->span instanceof Arrayable ? $this->span->toArray() : $this->span;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
        }
        return $data;
    }
}
