<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The component for adding a JSON data table.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/datatable.json
 */
class DataTable extends Component
{
    /**
     * An object that provides data for the table. This property also
     * provides information about the data, such as data types and header
     * labels, in the form of the data descriptor.
     * @var \Urbania\AppleNews\Format\RecordStore
     */
    protected $data;

    /**
     * Always datatable for this component.
     * @var string
     */
    protected $role = 'datatable';

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
     * An instance or array of component properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalComponent[]|\Urbania\AppleNews\Format\ConditionalComponent
     */
    protected $conditional;

    /**
     * A string value that determines the table orientation.
     * Valid values:
     * @var string
     */
    protected $dataOrientation;

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
     * A Boolean value that determines whether the headers are shown. If
     * true, the headers are visible, with the labels defined in the . If
     * false, the headers are not visible.
     * @var boolean
     */
    protected $showDescriptorLabels;

    /**
     * An array that determines how table data is sorted. Rules are applied
     * in the order in which they are provided in the array.
     * If this property is not defined, data records are displayed in the
     * order in which they are provided in the data .
     * @var Format\DataTableSorting[]
     */
    protected $sortBy;

    /**
     * An inline ComponentStyle object that defines the appearance of this
     * component or a string reference to a ComponentStyle object that is
     * defined at the top level of the document.
     * If this property is omitted, the table is styled according to a
     * component style called default-datatable. If default-datatable
     * doesn’t exist or doesn’t define table styling, the table is styled
     * according to a component style called default. If no table styling is
     * defined in any of these places, Apple News uses its built-in default
     * table styling.
     * The none value is used for conditional design elements. Adding it here
     * has no effect.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string|none
     */
    protected $style;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['data'])) {
            $this->setData($data['data']);
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

        if (isset($data['dataOrientation'])) {
            $this->setDataOrientation($data['dataOrientation']);
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

        if (isset($data['showDescriptorLabels'])) {
            $this->setShowDescriptorLabels($data['showDescriptorLabels']);
        }

        if (isset($data['sortBy'])) {
            $this->setSortBy($data['sortBy']);
        }

        if (isset($data['style'])) {
            $this->setStyle($data['style']);
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
     * Get the data
     * @return \Urbania\AppleNews\Format\RecordStore
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data
     * @param \Urbania\AppleNews\Format\RecordStore|array $data
     * @return $this
     */
    public function setData($data)
    {
        Assert::isSdkObject($data, RecordStore::class);

        $this->data = Utils::isAssociativeArray($data) ? new RecordStore($data) : $data;
        return $this;
    }

    /**
     * Get the dataOrientation
     * @return string
     */
    public function getDataOrientation()
    {
        return $this->dataOrientation;
    }

    /**
     * Set the dataOrientation
     * @param string $dataOrientation
     * @return $this
     */
    public function setDataOrientation($dataOrientation)
    {
        if (is_null($dataOrientation)) {
            $this->dataOrientation = null;
            return $this;
        }

        Assert::oneOf($dataOrientation, ['horizontal', 'vertical']);

        $this->dataOrientation = $dataOrientation;
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
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the showDescriptorLabels
     * @return boolean
     */
    public function getShowDescriptorLabels()
    {
        return $this->showDescriptorLabels;
    }

    /**
     * Set the showDescriptorLabels
     * @param boolean $showDescriptorLabels
     * @return $this
     */
    public function setShowDescriptorLabels($showDescriptorLabels)
    {
        if (is_null($showDescriptorLabels)) {
            $this->showDescriptorLabels = null;
            return $this;
        }

        Assert::boolean($showDescriptorLabels);

        $this->showDescriptorLabels = $showDescriptorLabels;
        return $this;
    }

    /**
     * Add an item to sortBy
     * @param \Urbania\AppleNews\Format\DataTableSorting|array $item
     * @return $this
     */
    public function addSortBy($item)
    {
        return $this->setSortBy(
            !is_null($this->sortBy) ? array_merge($this->sortBy, [$item]) : [$item]
        );
    }

    /**
     * Get the sortBy
     * @return Format\DataTableSorting[]
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * Set the sortBy
     * @param Format\DataTableSorting[] $sortBy
     * @return $this
     */
    public function setSortBy($sortBy)
    {
        if (is_null($sortBy)) {
            $this->sortBy = null;
            return $this;
        }

        Assert::isArray($sortBy);
        Assert::allIsSdkObject($sortBy, DataTableSorting::class);

        $this->sortBy = is_array($sortBy)
            ? array_reduce(
                array_keys($sortBy),
                function ($array, $key) use ($sortBy) {
                    $item = $sortBy[$key];
                    $array[$key] = Utils::isAssociativeArray($item)
                        ? new DataTableSorting($item)
                        : $item;
                    return $array;
                },
                []
            )
            : $sortBy;
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
        if (isset($this->data)) {
            $data['data'] = $this->data instanceof Arrayable ? $this->data->toArray() : $this->data;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
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
        if (isset($this->dataOrientation)) {
            $data['dataOrientation'] = $this->dataOrientation;
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
        if (isset($this->showDescriptorLabels)) {
            $data['showDescriptorLabels'] = $this->showDescriptorLabels;
        }
        if (isset($this->sortBy)) {
            $data['sortBy'] = !is_null($this->sortBy)
                ? array_reduce(
                    array_keys($this->sortBy),
                    function ($items, $key) {
                        $items[$key] =
                            $this->sortBy[$key] instanceof Arrayable
                                ? $this->sortBy[$key]->toArray()
                                : $this->sortBy[$key];
                        return $items;
                    },
                    []
                )
                : $this->sortBy;
        }
        if (isset($this->style)) {
            $data['style'] =
                $this->style instanceof Arrayable ? $this->style->toArray() : $this->style;
        }
        return $data;
    }
}
