<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Contracts\Api as ApiContract;
use Urbania\AppleNews\Api\Client;
use Urbania\AppleNews\Api\ChannelsClient;

class Api extends Client implements ApiContract
{
    /**
     * Get the channels API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\ChannelsClient
     */
    public function channels($channelId = null)
    {
        return new ChannelsClient($this, $channelId);
    }
}
