<?php

return [
    /**
     * Apple News API credentials
     */
    'api_key' => env('APPLE_NEWS_API_KEY'),
    'api_secret' => env('APPLE_NEWS_API_SECRET'),

    /**
     * Default channel ID
     */
    'channel_id' => env('APPLE_NEWS_CHANNEL_ID'),

    /**
     * Article default
     */
    'article' => [
        'language' => 'en-US',
        'version' => '1.7',
        'layout' => [
            'columns' => 12,
            'width' => 1024
        ],
    ],

    /**
     * Default parser
     */
    'parser' => 'html',

    /**
     * List of parsers.
     *
     * Available drivers: html, wordpress
     */
    'parsers' => [
        'html' => [
            'driver' => 'html',
            'article' => null
        ],
        'wordpress' => [
            'driver' => 'wordpress',
            'url' => null,
            'postUrlPattern' => null,
            'article' => null
        ]
    ]
];
