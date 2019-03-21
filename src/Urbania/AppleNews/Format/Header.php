<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for defining the top area of an article, chapter, or
 * section.
 *
 * @see https://developer.apple.com/documentation/apple_news/header
 */
class Header extends Component
{
    /**
     * An array of components to display as child components. Child
     * components are positioned and rendered relative to their parent
     * component.
     * @var Format\Component[]
     */
    protected $components = [];

    /**
     * Defines how child components are positioned within this header
     * component. For example, this property can allow for displaying child
     * components side-by-side and can make sure they are sized equally.
     * @var \Urbania\AppleNews\Format\CollectionDisplay
     */
    protected $contentDisplay;

    /**
     * This component always has a role of header.
     * @var string
     */
    protected $role = 'header';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['components'])) {
            $this->setComponents($data['components']);
        }

        if (isset($data['contentDisplay'])) {
            $this->setContentDisplay($data['contentDisplay']);
        }
    }

    /**
     * Add an item to components
     * @param \Urbania\AppleNews\Format\Component|array $item
     * @return $this
     */
    public function addComponent($item)
    {
        return $this->setComponents(array_merge($this->components, [$item]));
    }

    /**
     * Add items to components
     * @param array $items
     * @return $this
     */
    public function addComponents($items)
    {
        Assert::isArray($items);
        return $this->setComponents(array_merge($this->components, $items));
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

        $items = [];
        foreach ($components as $key => $item) {
            if ($item instanceof Componentable) {
                $items[$key] = $item->toComponent();
            } elseif (is_array($item)) {
                $items[$key] = Component::createTyped($item);
            } else {
                $items[$key] = $item;
            }
        }
        $this->components = $items;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
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
        return $data;
    }
}
