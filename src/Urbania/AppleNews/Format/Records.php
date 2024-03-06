<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Define and provide data records that fit within the structure defined
 * by descriptors for a data table.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/recordstore/records.json
 */
class Records extends BaseSdkObject
{
    /** @var array */
    protected $data;

    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * Get the data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        if (is_null($data)) {
            $this->data = null;
            return $this;
        }

        if (is_array($data) && sizeof($data) > 0) {
            Assert::isMap($data);
        }

        $this->data = $data;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
