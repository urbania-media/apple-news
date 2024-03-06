<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * A data category by which to sort the table in descending or ascending
 * order.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/datatablesorting.json
 */
class DataTableSorting extends BaseSdkObject
{
    /**
     * The identifier property of one of the table’s data descriptors. See
     * .
     * @var string
     */
    protected $descriptor;

    /**
     * The data sorting direction.
     * @var string
     */
    protected $direction;

    public function __construct(array $data = [])
    {
        if (isset($data['descriptor'])) {
            $this->setDescriptor($data['descriptor']);
        }

        if (isset($data['direction'])) {
            $this->setDirection($data['direction']);
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
     * Get the direction
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set the direction
     * @param string $direction
     * @return $this
     */
    public function setDirection($direction)
    {
        Assert::oneOf($direction, ['ascending', 'descending']);

        $this->direction = $direction;
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
        if (isset($this->direction)) {
            $data['direction'] = $this->direction;
        }
        return $data;
    }
}
