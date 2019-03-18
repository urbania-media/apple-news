<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining properties that affect the frequency and
 * placement with which banner advertisements and medium rectangle
 * advertisements are automatically placed in your article.
 *
 * @see https://developer.apple.com/documentation/apple_news/advertisingsettings
 */
class AdvertisingSettings implements \JsonSerializable
{
    /**
     * The banner type that should be shown.
     * @var string
     */
    protected $bannerType;

    /**
     * Either a number in points or a string referring to a supported unit of
     * measure that describes the minimum required distance between
     * automatically inserted advertisement components and media, such as
     * video, images, and embeds.
     * @var string|integer
     */
    protected $distanceFromMedia;

    /**
     * A number between 0 and 10 defining the frequency for automatically
     * inserting advertising components into articles.
     * @var integer
     */
    protected $frequency;

    /**
     * Layout object that currently supports margin only. An automatically
     * inserted advertising component uses the surrounding margins to make
     * sure it positions itself nicely in between components. If needed, the
     * margins that will be created around these advertisements can be
     * defined using this layout property.
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
     * @return string|integer
     */
    public function getDistanceFromMedia()
    {
        return $this->distanceFromMedia;
    }

    /**
     * Set the distanceFromMedia
     * @param string|integer $distanceFromMedia
     * @return $this
     */
    public function setDistanceFromMedia($distanceFromMedia)
    {
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
        if (is_object($layout)) {
            Assert::isInstanceOf($layout, AdvertisingLayout::class);
        } else {
            Assert::isArray($layout);
        }

        $this->layout = is_array($layout)
            ? new AdvertisingLayout($layout)
            : $layout;
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
        if (isset($this->bannerType)) {
            $data['bannerType'] = $this->bannerType;
        }
        if (isset($this->distanceFromMedia)) {
            $data['distanceFromMedia'] = is_object($this->distanceFromMedia)
                ? $this->distanceFromMedia->toArray()
                : $this->distanceFromMedia;
        }
        if (isset($this->frequency)) {
            $data['frequency'] = $this->frequency;
        }
        if (isset($this->layout)) {
            $data['layout'] = is_object($this->layout)
                ? $this->layout->toArray()
                : $this->layout;
        }
        return $data;
    }
}
