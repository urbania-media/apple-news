<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining conditions that will cause a conditional style
 * to be applied to a column.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/tablecolumnselector.json
 */
class TableColumnSelector extends BaseSdkObject
{
    /**
     * A number that specifies a column index. The leftmost column of data
     * has an index of . Only the column with the specific index is selected.
     * @var integer
     */
    protected $columnIndex;

    /**
     * A number that specifies the identifier of a specific data descriptor.
     * All columns for this data descriptor are selected. See .
     * When dataOrientation is set to vertical, which is the default, each
     * column displays data for one data descriptor. See .
     * @var string
     */
    protected $descriptor;

    /**
     * A Boolean value when true, selects the even columns.
     * @var boolean
     */
    protected $even;

    /**
     * A Boolean value when true, selects the odd columns.
     * @var boolean
     */
    protected $odd;

    public function __construct(array $data = [])
    {
        if (isset($data['columnIndex'])) {
            $this->setColumnIndex($data['columnIndex']);
        }

        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['even'])) {
            $this->setEven($data['even']);
        }

        if (isset($data['odd'])) {
            $this->setOdd($data['odd']);
        }
    }

    /**
     * Get the columnIndex
     * @return integer
     */
    public function getColumnIndex()
    {
        return $this->columnIndex;
    }

    /**
     * Set the columnIndex
     * @param integer $columnIndex
     * @return $this
     */
    public function setColumnIndex($columnIndex)
    {
        if (is_null($columnIndex)) {
            $this->columnIndex = null;
            return $this;
        }

        Assert::integer($columnIndex);

        $this->columnIndex = $columnIndex;
        return $this;
    }

    /**
     * Get the descriptor
     * @return string
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }

    /**
     * Set the descriptor
     * @param string $descriptor
     * @return $this
     */
    public function setDescriptor($descriptor)
    {
        if (is_null($descriptor)) {
            $this->descriptor = null;
            return $this;
        }

        Assert::string($descriptor);

        $this->descriptor = $descriptor;
        return $this;
    }

    /**
     * Get the even
     * @return boolean
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * Set the even
     * @param boolean $even
     * @return $this
     */
    public function setEven($even)
    {
        if (is_null($even)) {
            $this->even = null;
            return $this;
        }

        Assert::boolean($even);

        $this->even = $even;
        return $this;
    }

    /**
     * Get the odd
     * @return boolean
     */
    public function getOdd()
    {
        return $this->odd;
    }

    /**
     * Set the odd
     * @param boolean $odd
     * @return $this
     */
    public function setOdd($odd)
    {
        if (is_null($odd)) {
            $this->odd = null;
            return $this;
        }

        Assert::boolean($odd);

        $this->odd = $odd;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->columnIndex)) {
            $data['columnIndex'] = $this->columnIndex;
        }
        if (isset($this->descriptor)) {
            $data['descriptor'] = $this->descriptor;
        }
        if (isset($this->even)) {
            $data['even'] = $this->even;
        }
        if (isset($this->odd)) {
            $data['odd'] = $this->odd;
        }
        return $data;
    }
}
