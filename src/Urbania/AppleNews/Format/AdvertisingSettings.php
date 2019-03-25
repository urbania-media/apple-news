<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining properties that affect the frequency and
 * placement with which banner advertisements and medium rectangle
 * advertisements are automatically placed in your article.DeprecatedUse
 * AdvertisementAutoPlacement instead.
 *
 * @see https://developer.apple.com/documentation/apple_news/advertisingsettings
 */
class AdvertisingSettings extends BaseSdkObject
{
    /**
     * The banner type that should be shown.
     * @var string
     */
    protected $bannerType;

    /**
     * A number in points or a string referring to a supported unit of
     * measure that describes the minimum required distance between
     * automatically inserted advertisement components and media, such as
     * video, images, and embeds.
     * @var integer|string
     */
    protected $distanceFromMedia;

    /**
     * A number between 0 and 10 defining the frequency for automatically
     * inserting advertising components into articles.
     * @var integer
     */
    protected $frequency;

    /**
     * The Layout object that currently supports margin only. An
     * automatically inserted advertising component uses the surrounding
     * margins to make sure it positions itself nicely in between components.
     * If needed, the margins that is created around these advertisements can
     * be defined using this layout property.
     * @var \Urbania\AppleNews\Format\AdvertisingLayout
     */
    protected $layout;

    public function __construct(array $data = [])
    {
        if (isset($data['bannerType'])) {
            $this->setBannerType($data['bannerType']);
        }

        if (isset($data['distanceFromMedia'])) {
            $this->setDistanceFromMedia($data['distanceFromMedia']);
        }

        if (isset($data['frequency'])) {
            $this->setFrequency($data['frequency']);
        }

        if (isset($data['layout'])) {
            $this->setLayout($data['layout']);
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
     * Set the bannerType
     * @param string $bannerType
     * @return $this
     */
    public function setBannerType($bannerType)
    {
        if (is_null($bannerType)) {
            $this->bannerType = null;
            return $this;
        }

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
     * Get the distanceFromMedia
     * @return integer|string
     */
    public function getDistanceFromMedia()
    {
        return $this->distanceFromMedia;
    }

    /**
     * Set the distanceFromMedia
     * @param integer|string $distanceFromMedia
     * @return $this
     */
    public function setDistanceFromMedia($distanceFromMedia)
    {
        if (is_null($distanceFromMedia)) {
            $this->distanceFromMedia = null;
            return $this;
        }

        Assert::isSupportedUnits($distanceFromMedia);

        $this->distanceFromMedia = $distanceFromMedia;
        return $this;
    }

    /**
     * Get the frequency
     * @return integer
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set the frequency
     * @param integer $frequency
     * @return $this
     */
    public function setFrequency($frequency)
    {
        if (is_null($frequency)) {
            $this->frequency = null;
            return $this;
        }

        Assert::integer($frequency);

        $this->frequency = $frequency;
        return $this;
    }

    /**
     * Get the layout
     * @return \Urbania\AppleNews\Format\AdvertisingLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\AdvertisingLayout|array $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_null($layout)) {
            $this->layout = null;
            return $this;
        }

        Assert::isSdkObject($layout, AdvertisingLayout::class);

        $this->layout = is_array($layout)
            ? new AdvertisingLayout($layout)
            : $layout;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->bannerType)) {
            $data['bannerType'] = $this->bannerType;
        }
        if (isset($this->distanceFromMedia)) {
            $data['distanceFromMedia'] =
                $this->distanceFromMedia instanceof Arrayable
                    ? $this->distanceFromMedia->toArray()
                    : $this->distanceFromMedia;
        }
        if (isset($this->frequency)) {
            $data['frequency'] = $this->frequency;
        }
        if (isset($this->layout)) {
            $data['layout'] =
                $this->layout instanceof Arrayable
                    ? $this->layout->toArray()
                    : $this->layout;
        }
        return $data;
    }
}
