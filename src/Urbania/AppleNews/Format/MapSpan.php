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
class MapSpan
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
     * Get the longitudeDelta
     * @return integer|float
     */
    public function getLongitudeDelta()
    {
        return $this->longitudeDelta;
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
        return [
            'latitudeDelta' => $this->latitudeDelta,
            'longitudeDelta' => $this->longitudeDelta
        ];
    }
}
