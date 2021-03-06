<?php

namespace Urbania\AppleNews\Contracts;

interface Api
{
    /**
     * Get the channels API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\ChannelsClient
     */
    public function channels($channelId = null);
}
