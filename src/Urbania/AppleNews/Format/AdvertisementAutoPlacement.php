<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining the automatic placement of advertisements.
 *
 * @see https://developer.apple.com/documentation/apple_news/advertisementautoplacement
 */
class AdvertisementAutoPlacement extends AutoPlacement
{
    /**
     * A specific banner type that should be automatically inserted based on
     * the frequency value. If advertisement placement is enabled, only
     * banners of the defined size type are inserted.
     * @var string
     */
    protected $bannerType;

    /**
     * An array of automatic placement properties that can be applied
     * conditionally, and the conditions that cause them to be applied.
     * @var Format\ConditionalAutoPlacement[]
     */
    protected $conditional;

    /**
     * The minimum required distance between automatically inserted
     * advertisement components and media, such as Video and Photo. To
     * maintain a minimum distance of half a screen height from your media
     * content, use a value of around 50vh. For more information, see
     * Specifying Measurements for Components.
     * @var integer|string
     */
    protected $distanceFromMedia;

    /**
     * A Boolean that defines whether placement of advertisements is enabled.
     * @var boolean
     */
    protected $enabled;

    /**
     * A number from 0 to 10, defining the frequency for automatically
     * inserting BannerAdvertisement components into articles.
     * @var integer
     */
    protected $frequency;

    /**
     * The layout properties for automatically inserted components.
     * @var \Urbania\AppleNews\Format\AutoPlacementLayout
     */
    protected $layout;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['bannerType'])) {
            $this->setBannerType($data['bannerType']);
        }

        if (isset($data['conditional'])) {
            $this->setConditional($data['conditional']);
        }

        if (isset($data['distanceFromMedia'])) {
            $this->setDistanceFromMedia($data['distanceFromMedia']);
        }

        if (isset($data['enabled'])) {
            $this->setEnabled($data['enabled']);
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
     * Add an item to conditional
     * @param \Urbania\AppleNews\Format\ConditionalAutoPlacement|array $item
     * @return $this
     */
    public function addConditional($item)
    {
        return $this->setConditional(
            !is_null($this->conditional)
                ? array_merge($this->conditional, [$item])
                : [$item]
        );
    }

    /**
     * Get the conditional
     * @return Format\ConditionalAutoPlacement[]
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalAutoPlacement[] $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        Assert::isArray($conditional);
        Assert::allIsSdkObject($conditional, ConditionalAutoPlacement::class);

        $this->conditional = array_reduce(
            array_keys($conditional),
            function ($array, $key) use ($conditional) {
                $item = $conditional[$key];
                $array[$key] = is_array($item)
                    ? new ConditionalAutoPlacement($item)
                    : $item;
                return $array;
            },
            []
        );
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
     * Get the enabled
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set the enabled
     * @param boolean $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        if (is_null($enabled)) {
            $this->enabled = null;
            return $this;
        }

        Assert::boolean($enabled);

        $this->enabled = $enabled;
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
     * @return \Urbania\AppleNews\Format\AutoPlacementLayout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the layout
     * @param \Urbania\AppleNews\Format\AutoPlacementLayout|array $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        if (is_null($layout)) {
            $this->layout = null;
            return $this;
        }

        Assert::isSdkObject($layout, AutoPlacementLayout::class);

        $this->layout = is_array($layout)
            ? new AutoPlacementLayout($layout)
            : $layout;
        return $this;
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
        if (isset($this->conditional)) {
            $data['conditional'] = !is_null($this->conditional)
                ? array_reduce(
                    array_keys($this->conditional),
                    function ($items, $key) {
                        $items[$key] =
                            $this->conditional[$key] instanceof Arrayable
                                ? $this->conditional[$key]->toArray()
                                : $this->conditional[$key];
                        return $items;
                    },
                    []
                )
                : $this->conditional;
        }
        if (isset($this->distanceFromMedia)) {
            $data['distanceFromMedia'] =
                $this->distanceFromMedia instanceof Arrayable
                    ? $this->distanceFromMedia->toArray()
                    : $this->distanceFromMedia;
        }
        if (isset($this->enabled)) {
            $data['enabled'] = $this->enabled;
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
