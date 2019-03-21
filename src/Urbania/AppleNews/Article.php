<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Support\BaseObject;
use Urbania\AppleNews\Support\BaseObjectIterator;
use Urbania\AppleNews\Support\Concerns\GetMultipartBody;
use Urbania\AppleNews\Support\Concerns\SaveJsonToFile;
use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Api\Objects\Article as ApiArticle;
use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;
use Urbania\AppleNews\Support\Utils;

class Article extends BaseObject
{
    use GetMultipartBody, SaveJsonToFile;

    protected $article;

    protected $document;

    protected $metadata;

    /**
     * @param ApiArticle|ArticleDocument|string|array $data The article data
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metdata The article metadata
     */
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

    /**
     * Create an article from a JSON file
     * @param string $page The path to the JSON file
     * @return Article
     */
    public static function fromFile(string $path)
    {
        $contents = file_get_contents($path);
        return static::fromJson($contents);
    }

    /**
     * Create an article from a JSON string
     * @param string $json The JSON data
     * @return Article
     */
    public static function fromJson(string $json)
    {
        return new static(json_decode($json, true));
    }

    /**
     * Get the article
     * @return ApiArticle
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the document and metadata from an article
     * @param ApiArticle|array $article The article
     * @return $this
     */
    public function setArticle($article)
    {
        $this->article = is_array($article)
            ? new ApiArticle($article)
            : $article;
        $this->setDocument($this->article->getDocument());
        $this->setMetadata($this->article->toArray());
        return $this;
    }

    /**
     * Get the document
     * @return ArticleDocument
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the document
     * @param ArticleDocument|array|string $document The document
     * @return $this
     */
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

    /**
     * Merge a document into this one
     * @return $this
     */
    public function mergeDocument($document)
    {
        if (is_null($this->document)) {
            $this->setDocument($document);
        } else {
            $this->document->merge($document);
        }
        return $this;
    }

    /**
     * Get the article metadata
     * @return UpdateArticleMetadataFields|CreateArticleMetadataFields
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Set the article metadata
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
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
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        return $this->document->getIterator();
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
