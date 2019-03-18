<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

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
    protected $components;

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
     * Get the components
     * @return Format\Component[]
     */
    public function getComponents()
    {
        return $this->components;
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
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the components
     * @param Format\Component[] $components
     * @return $this
     */
    public function setComponents($components)
    {
        Assert::isArray($components);
        Assert::allIsInstanceOfOrArray($components, Component::class);

        $items = [];
        foreach ($components as $key => $item) {
            $items[$key] = is_array($item) ? new Component($item) : $item;
        }
        $this->components = $items;
        return $this;
    }

    /**
     * Set the contentDisplay
     * @param \Urbania\AppleNews\Format\CollectionDisplay|array $contentDisplay
     * @return $this
     */
    public function setContentDisplay($contentDisplay)
    {
        if (is_object($contentDisplay)) {
            Assert::isInstanceOf($contentDisplay, CollectionDisplay::class);
        } else {
            Assert::isArray($contentDisplay);
        }

        $this->contentDisplay = is_array($contentDisplay)
            ? new CollectionDisplay($contentDisplay)
            : $contentDisplay;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'components' => !is_null($this->components)
                ? array_reduce(
                    array_keys($this->components),
                    function ($items, $key) {
                        $items[$key] = is_object($this->components[$key])
                            ? $this->components[$key]->toArray()
                            : $this->components[$key];
                        return $items;
                    },
                    []
                )
                : $this->components,
            'contentDisplay' => is_object($this->contentDisplay)
                ? $this->contentDisplay->toArray()
                : $this->contentDisplay,
            'role' => $this->role
        ]);
    }
}
