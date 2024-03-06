<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining conditional properties for an automatically
 * placed component, and when the conditional properties are in effect.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/conditionalautoplacement.json
 */
class ConditionalAutoPlacement extends BaseSdkObject
{
    /**
     * An instance or array of conditions that, when met, cause the
     * conditional automatic placement properties to take effect.
     * @var Format\Condition[]|\Urbania\AppleNews\Format\Condition
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
     * Get the conditions
     * @return Format\Condition[]|\Urbania\AppleNews\Format\Condition
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set the conditions
     * @param Format\Condition[]|\Urbania\AppleNews\Format\Condition|array $conditions
     * @return $this
     */
    public function setConditions($conditions)
    {
        if (is_object($conditions) || Utils::isAssociativeArray($conditions)) {
            Assert::isSdkObject($conditions, Condition::class);
        } else {
            Assert::isArray($conditions);
            Assert::allIsSdkObject($conditions, Condition::class);
        }

        $this->conditions = Utils::isAssociativeArray($conditions)
            ? new Condition($conditions)
            : $conditions;
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

        $this->layout = Utils::isAssociativeArray($layout)
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
            $data['conditions'] =
                $this->conditions instanceof Arrayable
                    ? $this->conditions->toArray()
                    : $this->conditions;
        }
        if (isset($this->enabled)) {
            $data['enabled'] = $this->enabled;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        return $data;
    }
}
