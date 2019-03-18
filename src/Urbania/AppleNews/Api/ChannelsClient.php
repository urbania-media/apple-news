<?php

namespace Urbania\AppleNews\Api;

use Urbania\AppleNews\Api\Response\ChannelResponse;

class ChannelsClient
{
    protected $client;
    protected $channelId;

    public function __construct(Client $client, $channelId = null)
    {
        $this->client = $client;
        $this->channelId = $channelId;
    }

    public function getChannel($channelId = null)
    {
        if (is_null($channelId)) {
            $channelId  = $this->channelId;
        }

        $response = $this->client->makeRequest('/channels/'.$channelId);

        return new ChannelResponse($response);
    }
}
