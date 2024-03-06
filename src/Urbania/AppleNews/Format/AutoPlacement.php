<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for automatically placing components within Apple News
 * Format articles.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/autoplacement.json
 */
class AutoPlacement extends BaseSdkObject
{
    /**
     * The automatic placement of advertisement components. By default, no
     * advertising is automatically inserted.
     * @var \Urbania\AppleNews\Format\AdvertisementAutoPlacement
     */
    protected $advertisement;

    public function __construct(array $data = [])
    {
        if (isset($data['advertisement'])) {
            $this->setAdvertisement($data['advertisement']);
        }
    }

    /**
     * Get the advertisement
     * @return \Urbania\AppleNews\Format\AdvertisementAutoPlacement
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }

    /**
     * Set the advertisement
     * @param \Urbania\AppleNews\Format\AdvertisementAutoPlacement|array $advertisement
     * @return $this
     */
    public function setAdvertisement($advertisement)
    {
        if (is_null($advertisement)) {
            $this->advertisement = null;
            return $this;
        }

        Assert::isSdkObject($advertisement, AdvertisementAutoPlacement::class);

        $this->advertisement = Utils::isAssociativeArray($advertisement)
            ? new AdvertisementAutoPlacement($advertisement)
            : $advertisement;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->advertisement)) {
            $data['advertisement'] =
                $this->advertisement instanceof Arrayable
                    ? $this->advertisement->toArray()
                    : $this->advertisement;
        }
        return $data;
    }
}
