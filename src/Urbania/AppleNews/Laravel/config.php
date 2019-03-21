<?php

return [
    'api_key' => env('APPLE_NEWS_API_KEY'),
    'api_secret' => env('APPLE_NEWS_API_SECRET'),

    'channel_id' => env('APPLE_NEWS_CHANNEL_ID'),

    'parser' => 'html',

    'parsers' => [
        'html' => [
            'driver' => 'html'
        ],
        'wordpress' => [
            'driver' => 'wordpress'
        ]
    ]
];
