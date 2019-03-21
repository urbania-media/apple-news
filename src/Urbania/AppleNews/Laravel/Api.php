<?php

namespace Urbania\AppleNews\Laravel;

use Urbania\AppleNews\Api as BaseApi;

class Api extends BaseApi
{
    protected $channelId;

    public function __construct($apiKey, $apiSecret, $channelId, $opts = [])
    {
        parent::__construct($apiKey, $apiSecret, $channelId, $opts);
        $this->channelId = $channelId;
    }

    public function channels($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId = $this->channelId;
        }

        return parent::channels($channelId);
    }
}
