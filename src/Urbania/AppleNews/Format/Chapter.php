<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Concerns\FindsComponents;

/**
 * The component for organizing an article into chapters.
 *
 * @see https://developer.apple.com/documentation/apple_news/chapter
 */
class Chapter extends Component
{
    use FindsComponents;

    /**
     * An array of ComponentLink objects. This can be used to create a
     * ComponentLink, allowing a link to anywhere in News. Adding a link to a
     * chapter component will make the entire component interactable. Any
     * links used in its child components will no longer be interactable.
     * @var Format\ComponentLink[]
     */
    protected $additions;

    /**
     * An array of components to display as child components. Child
     * components are positioned and rendered relative to their parent
     * component.
     * @var Format\Component[]
     */
    protected $components;

    /**
     * Defines how child components are positioned within this chapter
     * component. For example, this property can allow for displaying child
     * components side-by-side and can make sure they are sized equally.
     * @var \Urbania\AppleNews\Format\CollectionDisplay
     */
    protected $contentDisplay;

    /**
     * This component always has a role of chapter.
     * @var string
     */
    protected $role = 'chapter';

    /**
     * A set of animations applied to any header component that is a child of
     * this chapter. See Scene.
     * @var \Urbania\AppleNews\Format\Scene
     */
    protected $scene;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['additions'])) {
            $this->setAdditions($data['additions']);
        }

        if (isset($data['components'])) {
            $this->setComponents($data['components']);
        }

        if (isset($data['contentDisplay'])) {
            $this->setContentDisplay($data['contentDisplay']);
        }

        if (isset($data['scene'])) {
            $this->setScene($data['scene']);
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
     * Get the contentDisplay
     * @return \Urbania\AppleNews\Format\CollectionDisplay
     */
    public function getContentDisplay()
    {
        return $this->contentDisplay;
    }

    /**
     * Set the contentDisplay
     * @param \Urbania\AppleNews\Format\CollectionDisplay|array $contentDisplay
     * @return $this
     */
    public function setContentDisplay($contentDisplay)
    {
        if (is_null($contentDisplay)) {
            $this->contentDisplay = null;
            return $this;
        }

        Assert::isSdkObject($contentDisplay, CollectionDisplay::class);

        $this->contentDisplay = is_array($contentDisplay)
            ? new CollectionDisplay($contentDisplay)
            : $contentDisplay;
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
        if (isset($this->contentDisplay)) {
            $data['contentDisplay'] =
                $this->contentDisplay instanceof Arrayable
                    ? $this->contentDisplay->toArray()
                    : $this->contentDisplay;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        if (isset($this->scene)) {
            $data['scene'] =
                $this->scene instanceof Arrayable
                    ? $this->scene->toArray()
                    : $this->scene;
        }
        return $data;
    }
}
