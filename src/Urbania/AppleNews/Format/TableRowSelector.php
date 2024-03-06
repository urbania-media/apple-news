<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining conditions that will cause a conditional style
 * to be applied to a row.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/tablerowselector.json
 */
class TableRowSelector extends BaseSdkObject
{
    /**
     * A string that specifies the identifier of a specific data descriptor.
     * All rows for this data descriptor will be selected. See .
     * When dataOrientation is set to horizontal, which is not the default
     * each row displays data for one data descriptor. See .
     * @var string
     */
    protected $descriptor;

    /**
     * A Boolean value when true, selects the even rows.
     * @var boolean
     */
    protected $even;

    /**
     * A Boolean value when true, selects the odd rows.
     * @var boolean
     */
    protected $odd;

    /**
     * A number that specifies a row index. The topmost row of data has an
     * index of . The specified column is selected.
     * @var integer
     */
    protected $rowIndex;

    public function __construct(array $data = [])
    {
        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['even'])) {
            $this->setEven($data['even']);
        }

        if (isset($data['odd'])) {
            $this->setOdd($data['odd']);
        }

        if (isset($data['rowIndex'])) {
            $this->setRowIndex($data['rowIndex']);
        }
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
     * Get the rowIndex
     * @return integer
     */
    public function getRowIndex()
    {
        return $this->rowIndex;
    }

    /**
     * Set the rowIndex
     * @param integer $rowIndex
     * @return $this
     */
    public function setRowIndex($rowIndex)
    {
        if (is_null($rowIndex)) {
            $this->rowIndex = null;
            return $this;
        }

        Assert::integer($rowIndex);

        $this->rowIndex = $rowIndex;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->descriptor)) {
            $data['descriptor'] = $this->descriptor;
        }
        if (isset($this->even)) {
            $data['even'] = $this->even;
        }
        if (isset($this->odd)) {
            $data['odd'] = $this->odd;
        }
        if (isset($this->rowIndex)) {
            $data['rowIndex'] = $this->rowIndex;
        }
        return $data;
    }
}
