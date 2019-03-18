<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object that contains JSON data for a data table.
 *
 * @see https://developer.apple.com/documentation/apple_news/recordstore
 */
class RecordStore
{
    /**
     * Provides information about the data that can be in each data record.
     * @var Format\DataDescriptor[]
     */
    protected $descriptors;

    /**
     * Provides data records that fit within the structure defined by
     * descriptors. Each descriptor can be used only once per record.
     * @var Format\Records[]
     */
    protected $records;

    public function __construct(array $data = [])
    {
        if (isset($data['descriptors'])) {
            $this->setDescriptors($data['descriptors']);
        }

        if (isset($data['records'])) {
            $this->setRecords($data['records']);
        }
    }

    /**
     * Get the descriptors
     * @return Format\DataDescriptor[]
     */
    public function getDescriptors()
    {
        return $this->descriptors;
    }

    /**
     * Get the records
     * @return Format\Records[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * Set the descriptors
     * @param Format\DataDescriptor[] $descriptors
     * @return $this
     */
    public function setDescriptors($descriptors)
    {
        Assert::isArray($descriptors);
        Assert::allIsInstanceOfOrArray($descriptors, DataDescriptor::class);

        $items = [];
        foreach ($descriptors as $key => $item) {
            $items[$key] = is_array($item) ? new DataDescriptor($item) : $item;
        }
        $this->descriptors = $items;
        return $this;
    }

    /**
     * Set the records
     * @param Format\Records[] $records
     * @return $this
     */
    public function setRecords($records)
    {
        Assert::isArray($records);
        Assert::allIsInstanceOfOrArray($records, Records::class);

        $items = [];
        foreach ($records as $key => $item) {
            $items[$key] = is_array($item) ? new Records($item) : $item;
        }
        $this->records = $items;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'descriptors' => !is_null($this->descriptors)
                ? array_reduce(
                    array_keys($this->descriptors),
                    function ($items, $key) {
                        $items[$key] = is_object($this->descriptors[$key])
                            ? $this->descriptors[$key]->toArray()
                            : $this->descriptors[$key];
                        return $items;
                    },
                    []
                )
                : $this->descriptors,
            'records' => !is_null($this->records)
                ? array_reduce(
                    array_keys($this->records),
                    function ($items, $key) {
                        $items[$key] = is_object($this->records[$key])
                            ? $this->records[$key]->toArray()
                            : $this->records[$key];
                        return $items;
                    },
                    []
                )
                : $this->records
        ];
    }
}
