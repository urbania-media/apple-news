<?php

if (! function_exists('appleNews')) {
    /**
     * Get the AppleNews instance
     *
     * @return \Urbania\AppleNews\Laravel\AppleNews
     */
    function appleNews()
    {
        return app('apple-news');
    }
}

if (! function_exists('article')) {
    /**
     * Create an article
     *
     * @param  object|array  $data
     * @param  object|array|null  $metadata
     * @return mixed
     */
    function article($data = [], $metadata = null)
    {
        return app('apple-news')->article($data, $metadata);
    }
}
