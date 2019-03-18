<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining conditions that will cause a conditional style
 * to be applied to a cell.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablecellselector
 */
class TableCellSelector
{
    /**
     * Specifies a column index. The leftmost column of data has an index of
     * 0.
     * @var integer
     */
    protected $columnIndex;

    /**
     * Specifies the identifier of a specific data descriptor. All cells for
     * this data descriptor will be selected. See DataDescriptor.
     * @var string
     */
    protected $descriptor;

    /**
     * When true, selects the cells in even columns.
     * @var boolean
     */
    protected $evenColumns;

    /**
     * When true, selects the cells in even rows.
     * @var boolean
     */
    protected $evenRows;

    /**
     * When true, selects the cells in odd columns.
     * @var boolean
     */
    protected $oddColumns;

    /**
     * When true, selects the cells in odd rows.
     * @var boolean
     */
    protected $oddRows;

    /**
     * Specifies a row index. The topmost row of data has an index of 0.
     * @var integer
     */
    protected $rowIndex;

    public function __construct(array $data = [])
    {
        if (isset($data['columnIndex'])) {
            $this->setColumnIndex($data['columnIndex']);
        }

        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['evenColumns'])) {
            $this->setEvenColumns($data['evenColumns']);
        }

        if (isset($data['evenRows'])) {
            $this->setEvenRows($data['evenRows']);
        }

        if (isset($data['oddColumns'])) {
            $this->setOddColumns($data['oddColumns']);
        }

        if (isset($data['oddRows'])) {
            $this->setOddRows($data['oddRows']);
        }

        if (isset($data['rowIndex'])) {
            $this->setRowIndex($data['rowIndex']);
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
     * Get the evenColumns
     * @return boolean
     */
    public function getEvenColumns()
    {
        return $this->evenColumns;
    }

    /**
     * Get the evenRows
     * @return boolean
     */
    public function getEvenRows()
    {
        return $this->evenRows;
    }

    /**
     * Get the oddColumns
     * @return boolean
     */
    public function getOddColumns()
    {
        return $this->oddColumns;
    }

    /**
     * Get the oddRows
     * @return boolean
     */
    public function getOddRows()
    {
        return $this->oddRows;
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
     * Set the evenColumns
     * @param boolean $evenColumns
     * @return $this
     */
    public function setEvenColumns($evenColumns)
    {
        Assert::boolean($evenColumns);

        $this->evenColumns = $evenColumns;
        return $this;
    }

    /**
     * Set the evenRows
     * @param boolean $evenRows
     * @return $this
     */
    public function setEvenRows($evenRows)
    {
        Assert::boolean($evenRows);

        $this->evenRows = $evenRows;
        return $this;
    }

    /**
     * Set the oddColumns
     * @param boolean $oddColumns
     * @return $this
     */
    public function setOddColumns($oddColumns)
    {
        Assert::boolean($oddColumns);

        $this->oddColumns = $oddColumns;
        return $this;
    }

    /**
     * Set the oddRows
     * @param boolean $oddRows
     * @return $this
     */
    public function setOddRows($oddRows)
    {
        Assert::boolean($oddRows);

        $this->oddRows = $oddRows;
        return $this;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'columnIndex' => $this->columnIndex,
            'descriptor' => $this->descriptor,
            'evenColumns' => $this->evenColumns,
            'evenRows' => $this->evenRows,
            'oddColumns' => $this->oddColumns,
            'oddRows' => $this->oddRows,
            'rowIndex' => $this->rowIndex
        ];
    }
}
