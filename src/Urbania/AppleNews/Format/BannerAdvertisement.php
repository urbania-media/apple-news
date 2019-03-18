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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'bannerType' => $this->bannerType,
            'role' => $this->role
        ]);
    }
}
