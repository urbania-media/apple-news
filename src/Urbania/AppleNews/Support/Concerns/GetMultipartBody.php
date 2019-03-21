<?php

namespace Urbania\AppleNews\Support\Concerns;

trait GetMultipartBody
{
    /**
     * Get the article as a multipart body
     * @return array The multipart body
     */
    public function getMultipartBody()
    {
        $body = [
            [
                'name' => 'article.json',
                'contents' => json_encode($this),
                'filename' => 'article.json',
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ]
        ];

        $metadata = $this->getMetadata();
        if (!is_null($metadata)) {
            $body[] = [
                'name' => 'metadata',
                'contents' => json_encode($metadata),
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ];
        }

        return $body;
    }
}
