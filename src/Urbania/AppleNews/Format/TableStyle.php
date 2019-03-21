<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining a style for rows, columns, cells, and headers
 * in a table.
 *
 * @see https://developer.apple.com/documentation/apple_news/tablestyle
 */
class TableStyle extends BaseSdkObject
{
    /**
     * Defines the styling for individual cells in a table.
     * @var \Urbania\AppleNews\Format\TableCellStyle
     */
    protected $cells;

    /**
     * Defines the styling for table columns.
     * @var \Urbania\AppleNews\Format\TableColumnStyle
     */
    protected $columns;

    /**
     * Defines the styling for individual cells in table headers.
     * @var \Urbania\AppleNews\Format\TableCellStyle
     */
    protected $headerCells;

    /**
     * Defines the styling for the table header columns, which are present if
     * dataOrientation is set to vertical, which is the default.
     * @var \Urbania\AppleNews\Format\TableColumnStyle
     */
    protected $headerColumns;

    /**
     * Defines the styling for table header rows, which are present if
     * dataOrientation is set to horizontal, which is not the default
     * @var \Urbania\AppleNews\Format\TableRowStyle
     */
    protected $headerRows;

    /**
     * Defines the styling for table rows.
     * @var \Urbania\AppleNews\Format\TableRowStyle
     */
    protected $rows;

    public function __construct(array $data = [])
    {
        if (isset($data['cells'])) {
            $this->setCells($data['cells']);
        }

        if (isset($data['columns'])) {
            $this->setColumns($data['columns']);
        }

        if (isset($data['headerCells'])) {
            $this->setHeaderCells($data['headerCells']);
        }

        if (isset($data['headerColumns'])) {
            $this->setHeaderColumns($data['headerColumns']);
        }

        if (isset($data['headerRows'])) {
            $this->setHeaderRows($data['headerRows']);
        }

        if (isset($data['rows'])) {
            $this->setRows($data['rows']);
        }
    }

    /**
     * Get the cells
     * @return \Urbania\AppleNews\Format\TableCellStyle
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Set the cells
     * @param \Urbania\AppleNews\Format\TableCellStyle|array $cells
     * @return $this
     */
    public function setCells($cells)
    {
        if (is_null($cells)) {
            $this->cells = null;
            return $this;
        }

        Assert::isSdkObject($cells, TableCellStyle::class);

        $this->cells = is_array($cells) ? new TableCellStyle($cells) : $cells;
        return $this;
    }

    /**
     * Get the columns
     * @return \Urbania\AppleNews\Format\TableColumnStyle
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the columns
     * @param \Urbania\AppleNews\Format\TableColumnStyle|array $columns
     * @return $this
     */
    public function setColumns($columns)
    {
        if (is_null($columns)) {
            $this->columns = null;
            return $this;
        }

        Assert::isSdkObject($columns, TableColumnStyle::class);

        $this->columns = is_array($columns)
            ? new TableColumnStyle($columns)
            : $columns;
        return $this;
    }

    /**
     * Get the headerCells
     * @return \Urbania\AppleNews\Format\TableCellStyle
     */
    public function getHeaderCells()
    {
        return $this->headerCells;
    }

    /**
     * Set the headerCells
     * @param \Urbania\AppleNews\Format\TableCellStyle|array $headerCells
     * @return $this
     */
    public function setHeaderCells($headerCells)
    {
        if (is_null($headerCells)) {
            $this->headerCells = null;
            return $this;
        }

        Assert::isSdkObject($headerCells, TableCellStyle::class);

        $this->headerCells = is_array($headerCells)
            ? new TableCellStyle($headerCells)
            : $headerCells;
        return $this;
    }

    /**
     * Get the headerColumns
     * @return \Urbania\AppleNews\Format\TableColumnStyle
     */
    public function getHeaderColumns()
    {
        return $this->headerColumns;
    }

    /**
     * Set the headerColumns
     * @param \Urbania\AppleNews\Format\TableColumnStyle|array $headerColumns
     * @return $this
     */
    public function setHeaderColumns($headerColumns)
    {
        if (is_null($headerColumns)) {
            $this->headerColumns = null;
            return $this;
        }

        Assert::isSdkObject($headerColumns, TableColumnStyle::class);

        $this->headerColumns = is_array($headerColumns)
            ? new TableColumnStyle($headerColumns)
            : $headerColumns;
        return $this;
    }

    /**
     * Get the headerRows
     * @return \Urbania\AppleNews\Format\TableRowStyle
     */
    public function getHeaderRows()
    {
        return $this->headerRows;
    }

    /**
     * Set the headerRows
     * @param \Urbania\AppleNews\Format\TableRowStyle|array $headerRows
     * @return $this
     */
    public function setHeaderRows($headerRows)
    {
        if (is_null($headerRows)) {
            $this->headerRows = null;
            return $this;
        }

        Assert::isSdkObject($headerRows, TableRowStyle::class);

        $this->headerRows = is_array($headerRows)
            ? new TableRowStyle($headerRows)
            : $headerRows;
        return $this;
    }

    /**
     * Get the rows
     * @return \Urbania\AppleNews\Format\TableRowStyle
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Set the rows
     * @param \Urbania\AppleNews\Format\TableRowStyle|array $rows
     * @return $this
     */
    public function setRows($rows)
    {
        if (is_null($rows)) {
            $this->rows = null;
            return $this;
        }

        Assert::isSdkObject($rows, TableRowStyle::class);

        $this->rows = is_array($rows) ? new TableRowStyle($rows) : $rows;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->cells)) {
            $data['cells'] =
                $this->cells instanceof Arrayable
                    ? $this->cells->toArray()
                    : $this->cells;
        }
        if (isset($this->columns)) {
            $data['columns'] =
                $this->columns instanceof Arrayable
                    ? $this->columns->toArray()
                    : $this->columns;
        }
        if (isset($this->headerCells)) {
            $data['headerCells'] =
                $this->headerCells instanceof Arrayable
                    ? $this->headerCells->toArray()
                    : $this->headerCells;
        }
        if (isset($this->headerColumns)) {
            $data['headerColumns'] =
                $this->headerColumns instanceof Arrayable
                    ? $this->headerColumns->toArray()
                    : $this->headerColumns;
        }
        if (isset($this->headerRows)) {
            $data['headerRows'] =
                $this->headerRows instanceof Arrayable
                    ? $this->headerRows->toArray()
                    : $this->headerRows;
        }
        if (isset($this->rows)) {
            $data['rows'] =
                $this->rows instanceof Arrayable
                    ? $this->rows->toArray()
                    : $this->rows;
        }
        return $data;
    }
}
