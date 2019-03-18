<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Custom key-value pairs for use in advertisement campaigns.
 *
 * @see https://developer.apple.com/documentation/apple_news/metadata/campaigndata
 */
class CampaignData
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
        return [];
    }
}
