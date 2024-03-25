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
     * Article defaults
     *
     * When creating an article with the Facade or the helper `article()` function,
     * the created article will always have these values as default.
     */
    'article' => [
        'language' => 'en-US',
        'version' => '1.7',
        'layout' => [
            'columns' => 12,
            'width' => 1024,
        ],
    ],

    /**
     * Default parser
     */
    'parser' => 'html',

    /**
     * List of parsers available.
     *
     * Available drivers: html, wordpress
     */
    'parsers' => [
        'html' => [
            // The HTML driver is used to parse HTML and converts it to components
            // in Apple News Format
            'driver' => 'html',

            // Any article defaults that will override the global article defaults
            'article' => null,
        ],

        'wordpress' => [
            // The Wordpress driver is used to parse a post from the Wordpress
            // REST API and return an article. It uses the HTML driver to parse
            // the content field of post
            'driver' => 'wordpress',

            // This is the base url of your Wordpress REST API
            // Example: http://example.com/wp-json/
            'url' => null,

            // This pattern is used to extract the postId from an url. The pattern
            // has to be a regex and contains a named capture group `postId`.
            // Example: `/http:\/\/example.com\/(?<postId>[0-9]+)\/(.*)/`
            'postUrlPattern' => null,

            // Any article defaults that will override the global article defaults
            'article' => null,
        ],
    ],

    'debug' => env('APPLE_NEWS_DEBUG', false),
];
