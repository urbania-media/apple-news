<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object that allows you to specify the number of digits after the
 * decimal point for numeric values in data table cells.
 *
 * @see https://developer.apple.com/documentation/apple_news/floatdataformat
 */
class FloatDataFormat extends DataFormat
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
        if (is_null($decimals)) {
            $this->decimals = null;
            return $this;
        }

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
