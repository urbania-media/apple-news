<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object that allows you to specify the number of digits after the
 * decimal point for numeric values in data table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/floatdataformat
 */
class FloatDataFormat extends DataFormat implements \JsonSerializable
{
    /**
     * The number of digits that can appear after the decimal point. The
     * number will be rounded to this number of digits after the decimal.
     * @var integer
     */
    protected $decimals;

    /**
     * The type of data format for this object. This must be float for a
     * FloatDataFormat object.
     * @var string
     */
    protected $type = 'float';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['decimals'])) {
            $this->setDecimals($data['decimals']);
        }
    }

    /**
     * Get the decimals
     * @return integer
     */
    public function getDecimals()
    {
        return $this->decimals;
    }

    /**
     * Set the decimals
     * @param integer $decimals
     * @return $this
     */
    public function setDecimals($decimals)
    {
        Assert::integer($decimals);

        $this->decimals = $decimals;
        return $this;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
        $data = parent::toArray();
        if (isset($this->decimals)) {
            $data['decimals'] = $this->decimals;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
