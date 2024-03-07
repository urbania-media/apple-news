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

    /**
     * Get the articles API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\ArticlesClient
     */
    public function articles($channelId = null);

    /**
     * Get the sections API Client
     * @param string|null $channelId The channel id
     * @return \Urbania\AppleNews\Api\SectionsClient
     */
    public function sections($channelId = null);
}
