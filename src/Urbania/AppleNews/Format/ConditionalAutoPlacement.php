<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining conditional properties for an automatically
 * placed component, and when the conditional properties are in effect.
 *
 * @see https://developer.apple.com/documentation/apple_news/conditionalautoplacement
 */
class ConditionalAutoPlacement extends BaseSdkObject
{
    /**
     * An array of conditions that, when met, cause the conditional automatic
     * placement properties to be in effect.
     * @var Format\Condition[]
     */
    protected $conditions;

    /**
     * A Boolean that defines whether placement of advertisements is enabled.
     * @var boolean
     */
    protected $enabled;

    /**
     * A value that defines the layout properties for the automatically
     * inserted components.
     * @var \Urbania\AppleNews\Format\AutoPlacementLayout
     */
    protected $layout;

    public function __construct(array $data = [])
    {
        if (isset($data['conditions'])) {
            $this->setConditions($data['conditions']);
        }

        if (isset($data['enabled'])) {
            $this->setEnabled($data['enabled']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
        }
    }

    /**
     * Add an item to conditions
     * @param \Urbania\AppleNews\Format\Condition|array $item
     * @return $this
     */
    public function addCondition($item)
    {
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, [$item])
                : [$item]
        );
    }

    /**
     * Add items to conditions
     * @param array $items
     * @return $this
     */
    public function addConditions($items)
    {
        Assert::isArray($items);
        return $this->setConditions(
            !is_null($this->conditions)
                ? array_merge($this->conditions, $items)
                : $items
        );
    }

    /**
     * Get the conditions
     * @return Format\Condition[]
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the conditions
     * @param Format\Condition[] $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        Assert::isArray($conditions);
        Assert::allIsSdkObject($conditions, Condition::class);

        $this->conditions = array_reduce(
            array_keys($conditions),
            function ($array, $key) use ($conditions) {
                $item = $conditions[$key];
                $array[$key] = is_array($item) ? new Condition($item) : $item;
                return $array;
            },
            []
        );
        return $this;
    }

    /**
     * Get the enabled
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the enabled
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        if (is_null($enabled)) {
            $this->enabled = null;
            return $this;
        }

        Assert::boolean($enabled);

        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get the layout
     * @return \Urbania\AppleNews\Format\AutoPlacementLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\AutoPlacementLayout|array $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_null($layout)) {
            $this->layout = null;
            return $this;
        }

        Assert::isSdkObject($layout, AutoPlacementLayout::class);

        $this->layout = is_array($layout)
            ? new AutoPlacementLayout($layout)
            : $layout;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->conditions)) {
            $data['conditions'] = !is_null($this->conditions)
                ? array_reduce(
                    array_keys($this->conditions),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditions[$key] instanceof Arrayable
                                ? $this->conditions[$key]->toArray()
                                : $this->conditions[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditions;
        }
        if (isset($this->enabled)) {
            $data['enabled'] = $this->enabled;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable
                    ? $this->layout->toArray()
                    : $this->layout;
        }
        return $data;
    }
}
