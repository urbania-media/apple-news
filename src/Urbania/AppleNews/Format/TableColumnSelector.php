<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining conditions that will cause a conditional style
 * to be applied to a column.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecolumnselector
 */
class TableColumnSelector
{
    /**
     * Specifies a column index. The leftmost column of data has an index of
     * 0. The specified column will be selected.
     * @var integer
     */
    protected $columnIndex;

    /**
     * Specifies the identifier of a specific data descriptor. All columns
     * for this data descriptor will be selected. See DataDescriptor.
     * @var string
     */
    protected $descriptor;

    /**
     * When true, selects the odd columns.
     * @var boolean
     */
    protected $odd;

    /**
     * When true, selects the even columns.
     * @var boolean
     */
    protected $even;

    public function __construct(array $data = [])
    {
        if (isset($data['columnIndex'])) {
            $this->setColumnIndex($data['columnIndex']);
        }

        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['odd'])) {
            $this->setOdd($data['odd']);
        }

        if (isset($data['even'])) {
            $this->setEven($data['even']);
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
     * Get the descriptor
     * @return string
     */
    public function getDescriptor()
    {
        return $this->descriptor;
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
     * Get the odd
     * @return boolean
     */
    public function getOdd()
    {
        return $this->odd;
    }

    /**
     * Set the columnIndex
     * @param integer $columnIndex
     * @return $this
     */
    public function setColumnIndex($columnIndex)
    {
        Assert::integer($columnIndex);

        $this->columnIndex = $columnIndex;
        return $this;
    }

    /**
     * Set the descriptor
     * @param string $descriptor
     * @return $this
     */
    public function setDescriptor($descriptor)
    {
        Assert::string($descriptor);

        $this->descriptor = $descriptor;
        return $this;
    }

    /**
     * Set the even
     * @param boolean $even
     * @return $this
     */
    public function setEven($even)
    {
        Assert::boolean($even);

        $this->even = $even;
        return $this;
    }

    /**
     * Set the odd
     * @param boolean $odd
     * @return $this
     */
    public function setOdd($odd)
    {
        Assert::boolean($odd);

        $this->odd = $odd;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
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
        if (isset($this->odd)) {
            $data['odd'] = $this->odd;
        }
        if (isset($this->even)) {
            $data['even'] = $this->even;
        }
        return $data;
    }
}
