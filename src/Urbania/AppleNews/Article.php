<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Api\Objects\Article as ApiArticle;
use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;
use Urbania\AppleNews\Support\Utils;
use Urbania\AppleNews\Support\BaseObject;

class Article extends BaseObject
{
    protected $article;

    protected $document;

    protected $metadata;

    public function __construct($data, $metadata = null)
    {
        if ($data instanceof ApiArticle ||
            (is_array($data) && isset($data['document']))
        ) {
            $this->setArticle($data);
        } else {
            $this->setDocument($data);
            $this->setMetadata($metadata);
        }
    }

    public static function fromFile(string $path)
    {
        $contents = file_get_contents($path);
        return static::fromJson($contents);
    }

    public static function fromJson(string $json)
    {
        return new static(json_decode($json, true));
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setArticle($article)
    {
        $this->article = is_array($article)
            ? new ApiArticle($article)
            : $article;
        $this->setDocument($this->article->getDocument());
        $this->setMetadata($this->article->toArray());
        return $this;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument($document)
    {
        if (is_string($document)) {
            $document = json_decode($document, true);
        }
        $this->document = is_array($document)
            ? new ArticleDocument($document)
            : $document;
        return $this;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function setMetadata($metadata)
    {
        if (is_array($metadata)) {
            $this->metadata = isset($metadata['revision'])
                ? new UpdateArticleMetadataFields($metadata)
                : new CreateArticleMetadataFields($metadata);
        } else {
            $this->metadata = $metadata;
        }
        return $this;
    }

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

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        return $this->document->{$name};
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        $this->document->{$name} = $value;
        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        unset($this->document->{$name});
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        return isset($this->document->{$name});
    }

    /**
     * Call method on the document
     * @param  string $name      The name of the method
     * @param  array  $arguments The arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->document, $name], $arguments);
    }

    /**
     * Get the document as array
     * @return array
     */
    public function toArray()
    {
        return $this->document->toArray();
    }
}
