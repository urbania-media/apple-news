<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for adding a map.
 *
 * @see https://developer.apple.com/documentation/apple_news/map
 */
class Map extends Component
{
    /**
     * The latitude of the map’s center. Provide both a latitude and
     * longitude, or an array of items.
     * @var integer|float
     */
    protected $latitude;

    /**
     * The longitude of the map’s center. Provide both a latitude and
     * longitude, or an array of items.
     * @var integer|float
     */
    protected $longitude;

    /**
     * Always map for this component.
     * @var string
     */
    protected $role = 'map';

    /**
     * The caption that describes what is visible on the map. The text is
     * used for VoiceOver for iOS and VoiceOver for macOS. The value in this
     * property should describe the contents of the map for non-sighted
     * users. If accessibilityCaption is not provided the caption value is
     * used for VoiceOver for iOS and VoiceOver for macOS.
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
     * @var \Urbania\AppleNews\Format\ComponentAnimation
     */
    protected $animation;

    /**
     * An object that defines behavior for a component, like Parallax or
     * Springy.
     * @var \Urbania\AppleNews\Format\Behavior
     */
    protected $behavior;

    /**
     * A string that describes what is displayed on the map. The caption is
     * displayed in the full screen version of the map. This text is also
     * used by VoiceOver for iOS and VoiceOver for macOS, if
     * accessibilityCaption text is not provided.
     * @var string
     */
    protected $caption;

    /**
     * An array of component properties that can be applied conditionally,
     * and the conditions that cause them to be applied.
     * @var Format\ConditionalComponent[]
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
     * An array of MapItems. If latitude and longitude are not set, at least
     * one item containing latitude and longitude should be added to the
     * items array.
     * @var Format\MapItem[]
     */
    protected $items;

    /**
     * An inline ComponentLayout object that contains layout information, or
     * a string reference to a ComponentLayout object that is defined at the
     * top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * A string that defines the type of map to display by default.
     * @var string
     */
    protected $mapType;

    /**
     * An object for defining the visible area of a map, relative to its
     * center. A span is defined in deltas for latitude and longitude.
     * @var \Urbania\AppleNews\Format\MapSpan
     */
    protected $span;

    /**
     * An inline ComponentStyle object that defines the appearance of this
     * component, or a string reference to a ComponentStyle object that is
     * defined at the top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string
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

        if (isset($data['items'])) {
            $this->setItems($data['items']);
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

        $this->anchor = is_array($anchor) ? new Anchor($anchor) : $anchor;
        return $this;
    }

    /**
     * Get the animation
     * @return \Urbania\AppleNews\Format\ComponentAnimation
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Set the animation
     * @param \Urbania\AppleNews\Format\ComponentAnimation|array $animation
     * @return $this
     */
    public function setAnimation($animation)
    {
        if (is_null($animation)) {
            $this->animation = null;
            return $this;
        }

        Assert::isSdkObject($animation, ComponentAnimation::class);

        $this->animation = is_array($animation)
            ? ComponentAnimation::createTyped($animation)
            : $animation;
        return $this;
    }

    /**
     * Get the behavior
     * @return \Urbania\AppleNews\Format\Behavior
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set the behavior
     * @param \Urbania\AppleNews\Format\Behavior|array $behavior
     * @return $this
     */
    public function setBehavior($behavior)
    {
        if (is_null($behavior)) {
            $this->behavior = null;
            return $this;
        }

        Assert::isSdkObject($behavior, Behavior::class);

        $this->behavior = is_array($behavior)
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
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalComponent|array $item
     * @return $this
     */
    public function addConditional($item)
    {
        return $this->setConditional(
            !is_null($this->conditional)
                ? array_merge($this->conditional, [$item])
                : [$item]
        );
    }

    /**
     * Get the conditional
     * @return Format\ConditionalComponent[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalComponent[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalComponent::class);

        $this->conditional = array_reduce(
            array_keys($conditional),
            function ($array, $key) use ($conditional) {
                $item = $conditional[$key];
                $array[$key] = is_array($item)
                    ? new ConditionalComponent($item)
                    : $item;
                return $array;
            },
            []
        );
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
     * Add an item to items
     * @param \Urbania\AppleNews\Format\MapItem|array $item
     * @return $this
     */
    public function addItem($item)
    {
        return $this->setItems(
            !is_null($this->items)
                ? array_merge($this->items, [$item])
                : [$item]
        );
    }

    /**
     * Add items to items
     * @param array $items
     * @return $this
     */
    public function addItems($items)
    {
        Assert::isArray($items);
        return $this->setItems(
            !is_null($this->items) ? array_merge($this->items, $items) : $items
        );
    }

    /**
     * Get the items
     * @return Format\MapItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the items
     * @param Format\MapItem[] $items
     * @return $this
     */
    public function setItems($items)
    {
        if (is_null($items)) {
            $this->items = null;
            return $this;
        }

        Assert::isArray($items);
        Assert::allIsSdkObject($items, MapItem::class);

        $this->items = array_reduce(
            array_keys($items),
            function ($array, $key) use ($items) {
                $item = $items[$key];
                $array[$key] = is_array($item) ? new MapItem($item) : $item;
                return $array;
            },
            []
        );
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

        if (is_object($layout) || is_array($layout)) {
            Assert::isSdkObject($layout, ComponentLayout::class);
        } else {
            Assert::string($layout);
        }

        $this->layout = is_array($layout)
            ? new ComponentLayout($layout)
            : $layout;
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

        Assert::oneOf($mapType, ["standard", "hybrid", "satellite"]);

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

        $this->span = is_array($span) ? new MapSpan($span) : $span;
        return $this;
    }

    /**
     * Get the style
     * @return \Urbania\AppleNews\Format\ComponentStyle|string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set the style
     * @param \Urbania\AppleNews\Format\ComponentStyle|array|string $style
     * @return $this
     */
    public function setStyle($style)
    {
        if (is_null($style)) {
            $this->style = null;
            return $this;
        }

        if (is_object($style) || is_array($style)) {
            Assert::isSdkObject($style, ComponentStyle::class);
        } else {
            Assert::string($style);
        }

        $this->style = is_array($style) ? new ComponentStyle($style) : $style;
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
                $this->anchor instanceof Arrayable
                    ? $this->anchor->toArray()
                    : $this->anchor;
        }
        if (isset($this->animation)) {
            $data['animation'] =
                $this->animation instanceof Arrayable
                    ? $this->animation->toArray()
                    : $this->animation;
        }
        if (isset($this->behavior)) {
            $data['behavior'] =
                $this->behavior instanceof Arrayable
                    ? $this->behavior->toArray()
                    : $this->behavior;
        }
        if (isset($this->caption)) {
            $data['caption'] = $this->caption;
        }
        if (isset($this->conditional)) {
            $data['conditional'] = !is_null($this->conditional)
                ? array_reduce(
                    array_keys($this->conditional),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditional[$key] instanceof Arrayable
                                ? $this->conditional[$key]->toArray()
                                : $this->conditional[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditional;
        }
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->items)) {
            $data['items'] = !is_null($this->items)
                ? array_reduce(
                    array_keys($this->items),
                    function ($items, $key) {
                        $items[$key] =
                            $this->items[$key] instanceof Arrayable
                                ? $this->items[$key]->toArray()
                                : $this->items[$key];
                        return $items;
                    },
                    []
                )
                : $this->items;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable
                    ? $this->layout->toArray()
                    : $this->layout;
        }
        if (isset($this->mapType)) {
            $data['mapType'] = $this->mapType;
        }
        if (isset($this->span)) {
            $data['span'] =
                $this->span instanceof Arrayable
                    ? $this->span->toArray()
                    : $this->span;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable
                    ? $this->style->toArray()
                    : $this->style;
        }
        return $data;
    }
}
