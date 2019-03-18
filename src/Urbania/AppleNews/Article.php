<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Api\Objects\Article as ApiArticle;
use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;

class Article implements \JsonSerializable
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

    public function __get(string $name)
    {
        return $this->document->{$name};
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->document, $name], $arguments);
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function toArray()
    {
        return $this->document->toArray();
    }
}
