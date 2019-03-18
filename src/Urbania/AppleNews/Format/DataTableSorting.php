<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * A data category by which to sort the table in descending or ascending
 * order.
 *
 * @see https://developer.apple.com/documentation/apple_news/datatablesorting
 */
class DataTableSorting implements \JsonSerializable
{
    /**
     * The identifier property of one of the table’s data descriptors. See
     * DataDescriptor.
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
        Assert::oneOf($direction, ["ascending", "descending"]);

        $this->direction = $direction;
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
        if (isset($this->direction)) {
            $data['direction'] = $this->direction;
        }
        return $data;
    }
}
