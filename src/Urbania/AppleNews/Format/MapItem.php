<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * An object used in a map component for specifying the location of a map
 * pin.
 *
 * @see https://developer.apple.com/documentation/apple_news/mapitem
 */
class MapItem extends BaseSdkObject
{
    /**
     * The caption for the map item. This caption will be displayed when a
     * user taps on a map pin.
     * @var string
     */
    protected $caption;

    /**
     * The latitude of the map item.
     * @var integer|float
     */
    protected $latitude;

    /**
     * The longitude of the map item.
     * @var integer|float
     */
    protected $longitude;

    public function __construct(array $data = [])
    {
        if (isset($data['caption'])) {
            $this->setCaption($data['caption']);
        }

        if (isset($data['latitude'])) {
            $this->setLatitude($data['latitude']);
        }

        if (isset($data['longitude'])) {
            $this->setLongitude($data['longitude']);
        }
    }

    /**
     * Get the caption
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the caption
     * @param string $caption
     * @return $this
     */
    public function setCaption($caption)
    {
        if (is_null($caption)) {
            $this->caption = null;
            return $this;
        }

        Assert::string($caption);

        $this->caption = $caption;
        return $this;
    }

    /**
     * Get the latitude
     * @return integer|float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the latitude
     * @param integer|float $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        Assert::number($latitude);

        $this->latitude = $latitude;
        return $this;
    }

    /**
     * Get the longitude
     * @return integer|float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the longitude
     * @param integer|float $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        Assert::number($longitude);

        $this->longitude = $longitude;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->caption)) {
            $data['caption'] = $this->caption;
        }
        if (isset($this->latitude)) {
            $data['latitude'] = $this->latitude;
        }
        if (isset($this->longitude)) {
            $data['longitude'] = $this->longitude;
        }
        return $data;
    }
}
