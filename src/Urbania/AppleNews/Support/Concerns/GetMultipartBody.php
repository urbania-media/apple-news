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

        $fonts = $this->getFonts();
        if (sizeof($fonts)) {
            foreach ($fonts as $key => $font) {
                $body[] = [
                    'name' => 'font-'.$key,
                    'filename' => basename($font),
                    'contents' => fopen($font, 'r'),
                    'headers' => [
                        'Content-type' => 'application/octet-stream'
                    ]
                ];
            }
        }

        $images = $this->getImages();
        if (sizeof($images)) {
            foreach ($images as $key => $image) {
                $body[] = [
                    'name' => 'image-'.$key,
                    'filename' => basename($image),
                    'contents' => fopen($image, 'r'),
                    'headers' => [
                        'Content-type' => mime_content_type($image)
                    ]
                ];
            }
        }

        return $body;
    }
}
