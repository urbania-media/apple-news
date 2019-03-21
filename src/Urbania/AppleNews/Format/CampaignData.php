<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * Custom key-value pairs for use in advertisement campaigns.
 *
 * @see https://developer.apple.com/documentation/apple_news/metadata/campaigndata
 */
class CampaignData extends BaseSdkObject
{
    public function __construct(array $data = [])
    {
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        return $data;
    }
}
