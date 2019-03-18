<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining conditions that will cause a conditional style
 * to be applied to a row.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablerowselector
 */
class TableRowSelector implements \JsonSerializable
{
    /**
     * Specifies the identifier of a specific data descriptor. All rows for
     * this data descriptor will be selected. See DataDescriptor.
     * @var string
     */
    protected $descriptor;

    /**
     * Specifies a row index. The topmost row of data has an index of 0. The
     * specified column will be selected.
     * @var integer
     */
    protected $rowIndex;

    /**
     * When true, selects the odd rows.
     * @var boolean
     */
    protected $odd;

    /**
     * When true, selects the even rows.
     * @var boolean
     */
    protected $even;

    public function __construct(array $data = [])
    {
        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['rowIndex'])) {
            $this->setRowIndex($data['rowIndex']);
        }

        if (isset($data['odd'])) {
            $this->setOdd($data['odd']);
        }

        if (isset($data['even'])) {
            $this->setEven($data['even']);
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
        Assert::integer($rowIndex);

        $this->rowIndex = $rowIndex;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
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
        if (isset($this->descriptor)) {
            $data['descriptor'] = $this->descriptor;
        }
        if (isset($this->rowIndex)) {
            $data['rowIndex'] = $this->rowIndex;
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
