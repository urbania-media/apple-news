<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Contracts\Api as ApiContract;
use Urbania\AppleNews\Api\Client;
use Urbania\AppleNews\Api\ChannelsClient;
use Urbania\AppleNews\Api\ArticlesClient;
use Urbania\AppleNews\Api\SectionsClient;

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

    /**
     * Get the articles API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\ArticlesClient
     */
    public function articles($channelId = null)
    {
        return new ArticlesClient($this, $channelId);
    }

    /**
     * Get the sections API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\SectionsClient
     */
    public function sections($channelId = null)
    {
        return new SectionsClient($this, $channelId);
    }
}
