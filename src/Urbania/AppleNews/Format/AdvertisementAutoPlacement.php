<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the automatic placement of advertisements.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/advertisementautoplacement.json
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
     * An instance or array of automatic placement properties that can be
     * applied conditionally, and the conditions that cause them to take
     * effect.
     * @var Format\ConditionalAutoPlacement[]|\Urbania\AppleNews\Format\ConditionalAutoPlacement
     */
    protected $conditional;

    /**
     * The minimum required distance between automatically inserted
     * advertisement components and media, such as  and . Advertisements will
     * show next to media if distanceFromMedia is not specified. To maintain
     * a minimum distance of half a screen height from your media content,
     * use a value of around 10vh. For more information, see .
     * @var string|integer|float
     */
    protected $distanceFromMedia;

    /**
     * A Boolean that defines whether placement of advertisements is enabled.
     *
     * @var boolean
     */
    protected $enabled;

    /**
     * A number from  to 10, defining the frequency for automatically
     * inserting ads into articles.
     * Setting this value to 1 automatically inserts a dynamic advertisement
     * in the first possible location below the screen bounds.
     * Setting this value to 2 inserts a dynamic advertisement in the first
     * possible location below the screen bounds, and another between the
     * first dynamic advertisement and the end of the article.
     * Increasing the frequency value increases the frequency of dynamic
     * advertisements below the first screen bounds.
     * Setting this value to 0, or omitting it, results in no advertisements.
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

        Assert::oneOf($bannerType, ['any', 'standard', 'double_height', 'large']);

        $this->bannerType = $bannerType;
        return $this;
    }

    /**
     * Get the conditional
     * @return Format\ConditionalAutoPlacement[]|\Urbania\AppleNews\Format\ConditionalAutoPlacement
     */
    public function getConditional()
    {
        return $this->conditional;
    }

    /**
     * Set the conditional
     * @param Format\ConditionalAutoPlacement[]|\Urbania\AppleNews\Format\ConditionalAutoPlacement|array $conditional
     * @return $this
     */
    public function setConditional($conditional)
    {
        if (is_null($conditional)) {
            $this->conditional = null;
            return $this;
        }

        if (is_object($conditional) || Utils::isAssociativeArray($conditional)) {
            Assert::isSdkObject($conditional, ConditionalAutoPlacement::class);
        } else {
            Assert::isArray($conditional);
            Assert::allIsSdkObject($conditional, ConditionalAutoPlacement::class);
        }

        $this->conditional = Utils::isAssociativeArray($conditional)
            ? new ConditionalAutoPlacement($conditional)
            : $conditional;
        return $this;
    }

    /**
     * Get the distanceFromMedia
     * @return string|integer|float
     */
    public function getDistanceFromMedia()
    {
        return $this->distanceFromMedia;
    }

    /**
     * Set the distanceFromMedia
     * @param string|integer|float $distanceFromMedia
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

        $this->layout = Utils::isAssociativeArray($layout)
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
            $data['conditional'] =
                $this->conditional instanceof Arrayable
                    ? $this->conditional->toArray()
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
                $this->layout instanceof Arrayable ? $this->layout->toArray() : $this->layout;
        }
        return $data;
    }
}
