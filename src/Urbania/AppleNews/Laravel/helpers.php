<?php

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
