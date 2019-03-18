<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for adding a full-width banner ad.
 *
 * @see https://developer.apple.com/documentation/apple_news/banneradvertisement
 */
class BannerAdvertisement extends Component
{
    /**
     * The type of banner to show.
     * @var string
     */
    protected $bannerType;

    /**
     * This component always has a role of banner_advertisement.
     * @var string
     */
    protected $role = 'banner_advertisement';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['bannerType'])) {
            $this->setBannerType($data['bannerType']);
        }
    }

    /**
     * Get the bannerType
     * @return string
     */
    public function getBannerType()
    {
        return $this->bannerType;
    }

    /**
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the bannerType
     * @param string $bannerType
     * @return $this
     */
    public function setBannerType($bannerType)
    {
        Assert::oneOf($bannerType, [
            "any",
            "standard",
            "double_height",
            "large"
        ]);

        $this->bannerType = $bannerType;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        if (isset($this->bannerType)) {
            $data['bannerType'] = $this->bannerType;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        return $data;
    }
}
