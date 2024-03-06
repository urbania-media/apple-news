<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * An object used in a map or place component for defining the visible
 * area of the map.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/mapspan.json
 */
class MapSpan extends BaseSdkObject
{
    /**
     * A float value between 0.0 and 90.0.
     * @var integer|float
     */
    protected $latitudeDelta;

    /**
     * A float value between 0.0 and 180.0.
     * @var integer|float
     */
    protected $longitudeDelta;

    public function __construct(array $data = [])
    {
        if (isset($data['latitudeDelta'])) {
            $this->setLatitudeDelta($data['latitudeDelta']);
        }

        if (isset($data['longitudeDelta'])) {
            $this->setLongitudeDelta($data['longitudeDelta']);
        }
    }

    /**
     * Get the latitudeDelta
     * @return integer|float
     */
    public function getLatitudeDelta()
    {
        return $this->latitudeDelta;
    }

    /**
     * Set the latitudeDelta
     * @param integer|float $latitudeDelta
     * @return $this
     */
    public function setLatitudeDelta($latitudeDelta)
    {
        Assert::number($latitudeDelta);

        $this->latitudeDelta = $latitudeDelta;
        return $this;
    }

    /**
     * Get the longitudeDelta
     * @return integer|float
     */
    public function getLongitudeDelta()
    {
        return $this->longitudeDelta;
    }

    /**
     * Set the longitudeDelta
     * @param integer|float $longitudeDelta
     * @return $this
     */
    public function setLongitudeDelta($longitudeDelta)
    {
        Assert::number($longitudeDelta);

        $this->longitudeDelta = $longitudeDelta;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->latitudeDelta)) {
            $data['latitudeDelta'] = $this->latitudeDelta;
        }
        if (isset($this->longitudeDelta)) {
            $data['longitudeDelta'] = $this->longitudeDelta;
        }
        return $data;
    }
}
