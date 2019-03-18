<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * An object used in a map or place component for defining the visible
 * area of the map.
 *
 * @see https://developer.apple.com/documentation/apple_news/mapspan
 */
class MapSpan implements \JsonSerializable
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
        if (isset($this->latitudeDelta)) {
            $data['latitudeDelta'] = $this->latitudeDelta;
        }
        if (isset($this->longitudeDelta)) {
            $data['longitudeDelta'] = $this->longitudeDelta;
        }
        return $data;
    }
}
