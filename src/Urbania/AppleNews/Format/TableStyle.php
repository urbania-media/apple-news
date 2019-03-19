<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
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

        if (is_object($cells)) {
            Assert::isInstanceOf($cells, TableCellStyle::class);
        } else {
            Assert::isArray($cells);
        }

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

        if (is_object($columns)) {
            Assert::isInstanceOf($columns, TableColumnStyle::class);
        } else {
            Assert::isArray($columns);
        }

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

        if (is_object($headerCells)) {
            Assert::isInstanceOf($headerCells, TableCellStyle::class);
        } else {
            Assert::isArray($headerCells);
        }

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

        if (is_object($headerColumns)) {
            Assert::isInstanceOf($headerColumns, TableColumnStyle::class);
        } else {
            Assert::isArray($headerColumns);
        }

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

        if (is_object($headerRows)) {
            Assert::isInstanceOf($headerRows, TableRowStyle::class);
        } else {
            Assert::isArray($headerRows);
        }

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

        if (is_object($rows)) {
            Assert::isInstanceOf($rows, TableRowStyle::class);
        } else {
            Assert::isArray($rows);
        }

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
            $data['cells'] = is_object($this->cells)
                ? $this->cells->toArray()
                : $this->cells;
        }
        if (isset($this->columns)) {
            $data['columns'] = is_object($this->columns)
                ? $this->columns->toArray()
                : $this->columns;
        }
        if (isset($this->headerCells)) {
            $data['headerCells'] = is_object($this->headerCells)
                ? $this->headerCells->toArray()
                : $this->headerCells;
        }
        if (isset($this->headerColumns)) {
            $data['headerColumns'] = is_object($this->headerColumns)
                ? $this->headerColumns->toArray()
                : $this->headerColumns;
        }
        if (isset($this->headerRows)) {
            $data['headerRows'] = is_object($this->headerRows)
                ? $this->headerRows->toArray()
                : $this->headerRows;
        }
        if (isset($this->rows)) {
            $data['rows'] = is_object($this->rows)
                ? $this->rows->toArray()
                : $this->rows;
        }
        return $data;
    }
}
