<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Concerns\FindsComponents;

/**
 * The component for organizing an article into sections.
 *
 * @see https://developer.apple.com/documentation/apple_news/section-ka8
 */
class Section extends Container
{
    use FindsComponents;

    /**
     * Always section for this component.
     * @var string
     */
    protected $role = 'section';

    /**
     * An array of ComponentLink objects. This can be used to create a
     * ComponentLink, allowing a link to anywhere in News. Adding a link to a
     * section component will make the entire component interactable. Any
     * links used in its child components are not interactable.
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
     * An array of components to display as child components. Child
     * components are positioned and rendered relative to their parent
     * component.
     * @var Format\Component[]
     */
    protected $components;

    /**
     * An array of section properties that can be applied conditionally, and
     * the conditions that cause them to be applied.
     * @var Format\ConditionalSection[]
     */
    protected $conditional;

    /**
     * Defines how child components are positioned within this section
     * component. For example, this property can allow for displaying child
     * components side-by-side and can make sure they are sized equally.
     * @var \Urbania\AppleNews\Format\CollectionDisplay|\Urbania\AppleNews\Format\HorizontalStackDisplay
     */
    protected $contentDisplay;

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
     * @var \Urbania\AppleNews\Format\ComponentLayout|string
     */
    protected $layout;

    /**
     * A set of animations applied to any header component that is a child of
     * this section.
     * @var \Urbania\AppleNews\Format\Scene
     */
    protected $scene;

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

        if (isset($data['components'])) {
            $this->setComponents($data['components']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['contentDisplay'])) {
            $this->setContentDisplay($data['contentDisplay']);
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

        if (isset($data['scene'])) {
            $this->setScene($data['scene']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
        }
    }

    /**
     * Add an item to additions
     * @param \Urbania\AppleNews\Format\ComponentLink|array $item
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

        $this->additions = array_reduce(
            array_keys($additions),
            function ($array, $key) use ($additions) {
                $item = $additions[$key];
                $array[$key] = is_array($item)
                    ? new ComponentLink($item)
                    : $item;
                return $array;
            },
            []
        );
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
     * Add an item to components
     * @param \Urbania\AppleNews\Format\Component|array $item
     * @return $this
     */
    public function addComponent($item)
    {
        return $this->setComponents(
            !is_null($this->components)
                ? array_merge($this->components, [$item])
                : [$item]
        );
    }

    /**
     * Add items to components
     * @param array $items
     * @return $this
     */
    public function addComponents($items)
    {
        Assert::isArray($items);
        return $this->setComponents(
            !is_null($this->components)
                ? array_merge($this->components, $items)
                : $items
        );
    }

    /**
     * Get the components
     * @return Format\Component[]
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * Set the components
     * @param Format\Component[] $components
     * @return $this
     */
    public function setComponents($components)
    {
        if (is_null($components)) {
            $this->components = null;
            return $this;
        }

        Assert::isArray($components);
        Assert::allIsComponent($components);

        $this->components = array_reduce(
            array_keys($components),
            function ($array, $key) use ($components) {
                $item = $components[$key];
                if ($item instanceof Componentable) {
                    $array[$key] = $item->toComponent();
                } elseif (is_array($item)) {
                    $array[$key] = Component::createTyped($item);
                } else {
                    $array[$key] = $item;
                }
                return $array;
            },
            []
        );

        return $this;
    }

    /**
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalSection|array $item
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
     * @return Format\ConditionalSection[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalSection[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalSection::class);

        $this->conditional = array_reduce(
            array_keys($conditional),
            function ($array, $key) use ($conditional) {
                $item = $conditional[$key];
                $array[$key] = is_array($item)
                    ? new ConditionalSection($item)
                    : $item;
                return $array;
            },
            []
        );
        return $this;
    }

    /**
     * Get the contentDisplay
     * @return \Urbania\AppleNews\Format\CollectionDisplay|\Urbania\AppleNews\Format\HorizontalStackDisplay
     */
    public function getContentDisplay()
    {
        return $this->contentDisplay;
    }

    /**
     * Set the contentDisplay
     * @param \Urbania\AppleNews\Format\CollectionDisplay|array|\Urbania\AppleNews\Format\HorizontalStackDisplay $contentDisplay
     * @return $this
     */
    public function setContentDisplay($contentDisplay)
    {
        if (is_null($contentDisplay)) {
            $this->contentDisplay = null;
            return $this;
        }

        Assert::isAnySdkObject($contentDisplay, [
            CollectionDisplay::class,
            HorizontalStackDisplay::class
        ]);

        if (is_array($contentDisplay)) {
            $typeObjects = [
                'collection' => CollectionDisplay::class,
                'horizontal_stack' => HorizontalStackDisplay::class
            ];
            $this->contentDisplay = array_reduce(
                array_keys($typeObjects),
                function ($ret, $k) use ($typeObjects, $contentDisplay) {
                    $classPath = $typeObjects[$k];
                    return isset($contentDisplay['type']) &&
                        $contentDisplay['type'] === $k
                        ? new $classPath($contentDisplay)
                        : $ret;
                },
                null
            );
        } else {
            $this->contentDisplay = $contentDisplay;
        }
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
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the scene
     * @return \Urbania\AppleNews\Format\Scene
     */
    public function getScene()
    {
        return $this->scene;
    }

    /**
     * Set the scene
     * @param \Urbania\AppleNews\Format\Scene|array $scene
     * @return $this
     */
    public function setScene($scene)
    {
        if (is_null($scene)) {
            $this->scene = null;
            return $this;
        }

        Assert::isSdkObject($scene, Scene::class);

        $this->scene = is_array($scene) ? Scene::createTyped($scene) : $scene;
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
        if (isset($this->role)) {
            $data['role'] = $this->role;
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
        if (isset($this->components)) {
            $data['components'] = !is_null($this->components)
                ? array_reduce(
                    array_keys($this->components),
                    function ($items, $key) {
                        $items[$key] =
                            $this->components[$key] instanceof Arrayable
                                ? $this->components[$key]->toArray()
                                : $this->components[$key];
                        return $items;
                    },
                    []
                )
                : $this->components;
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
        if (isset($this->contentDisplay)) {
            $data['contentDisplay'] =
                $this->contentDisplay instanceof Arrayable
                    ? $this->contentDisplay->toArray()
                    : $this->contentDisplay;
        }
        if (isset($this->hidden)) {
            $data['hidden'] = $this->hidden;
        }
        if (isset($this->identifier)) {
            $data['identifier'] = $this->identifier;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable
                    ? $this->layout->toArray()
                    : $this->layout;
        }
        if (isset($this->scene)) {
            $data['scene'] =
                $this->scene instanceof Arrayable
                    ? $this->scene->toArray()
                    : $this->scene;
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
