<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for adding a JSON data table.
 *
 * @see https://developer.apple.com/documentation/apple_news/datatable
 */
class DataTable extends Component
{
    /**
     * Provides data for the table. Also provides information about the data,
     * such as data types and header labels, in the form of the data
     * descriptor.
     * @var \Urbania\AppleNews\Format\RecordStore
     */
    protected $data;

    /**
     * Determines the table orientation. Valid values:
     * @var string
     */
    protected $dataOrientation;

    /**
     * This component always has a role of datatable.
     * @var string
     */
    protected $role = 'datatable';

    /**
     * Determines whether the headers are shown. If true, the headers will be
     * visible, with the labels defined in the RecordStore. If false, the
     * headers will not be visible.
     * @var boolean
     */
    protected $showDescriptorLabels;

    /**
     * An array that determines how table data is sorted. Rules are applied
     * in the order in which they are provided in the array.
     * @var Format\DataTableSorting[]
     */
    protected $sortBy = [];

    /**
     * Either an inline ComponentStyle object that defines the appearance of
     * this component or a string reference to a component style that is
     * defined at the top level of the document.
     * @var \Urbania\AppleNews\Format\ComponentStyle|string
     */
    protected $style;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['data'])) {
            $this->setData($data['data']);
        }

        if (isset($data['dataOrientation'])) {
            $this->setDataOrientation($data['dataOrientation']);
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

        $this->data = is_array($data) ? new RecordStore($data) : $data;
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

        Assert::oneOf($dataOrientation, ["horizontal", "vertical"]);

        $this->dataOrientation = $dataOrientation;
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
        return $this->setSortBy(array_merge($this->sortBy, [$item]));
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

        $items = [];
        foreach ($sortBy as $key => $item) {
            $items[$key] = is_array($item)
                ? new DataTableSorting($item)
                : $item;
        }
        $this->sortBy = $items;
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

        if (is_object($style)) {
            Assert::isSdkObject($style, ComponentStyle::class);
        } elseif (!is_array($style)) {
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
        if (isset($this->data)) {
            $data['data'] =
                $this->data instanceof Arrayable
                    ? $this->data->toArray()
                    : $this->data;
        }
        if (isset($this->dataOrientation)) {
            $data['dataOrientation'] = $this->dataOrientation;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
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
                $this->style instanceof Arrayable
                    ? $this->style->toArray()
                    : $this->style;
        }
        return $data;
    }
}
