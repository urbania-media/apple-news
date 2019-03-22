<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Support\BaseObject;
use Urbania\AppleNews\Support\BaseObjectIterator;
use Urbania\AppleNews\Support\Concerns\GetMultipartBody;
use Urbania\AppleNews\Support\Concerns\SaveJsonToFile;
use Urbania\AppleNews\Support\Concerns\FindsComponents;
use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Api\Objects\Article as ApiArticle;
use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;
use Urbania\AppleNews\Support\Utils;
use Urbania\AppleNews\Contracts\Theme as ThemeContract;
use Urbania\AppleNews\Contracts\Article as ArticleContract;

class Article extends BaseObject implements ArticleContract
{
    use GetMultipartBody, SaveJsonToFile, FindsComponents;

    protected $article;

    protected $document;

    protected $documentWithTheme;

    protected $metadata;

    protected $theme;

    /**
     * @param ApiArticle|ArticleDocument|string|array $data The article data
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metdata The article metadata
     */
    public function __construct($data = [], $metadata = null)
    {
        if ($data instanceof self) {
            $this->merge($data, $metadata);
        } elseif ($data instanceof ApiArticle ||
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
     * Get the document with applyied theme
     * @return ArticleDocument
     */
    public function getDocumentWithTheme()
    {
        return $this->documentWithTheme;
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

        $this->updateTheme();

        return $this;
    }

    /**
     * Merge a document into this article
     * @param ArticleDocument|array|string $document The document
     * @return $this
     */
    public function mergeDocument($document)
    {
        if (is_null($document)) {
            return $this;
        }
        if (is_null($this->document)) {
            $this->setDocument($document);
        } else {
            $this->document->merge($document);
            $this->updateTheme();
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
     * Merge metadata into this article
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
    public function mergeMetadata($metadata)
    {
        if (is_null($metadata)) {
            return $this;
        }
        if (is_null($this->metadata)) {
            $this->setMetadata($metadata);
        } else {
            $this->metadata->merge($metadata);
        }
        return $this;
    }

    /**
     * Get the article theme
     * @return ThemeContract
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set the article theme
     * @param ThemeContract $metadata The metadata
     * @return $this
     */
    public function setTheme(ThemeContract $theme)
    {
        $this->theme = $theme;
        $this->updateTheme();
        return $this;
    }

    /**
     * Update the theme on the document
     * @return void
     */
    protected function updateTheme()
    {
        if (!is_null($this->theme) && !is_null($this->document)) {
            $this->documentWithTheme = $this->theme->apply($this->document);
        } else {
            $this->documentWithTheme = null;
        }
    }

    /**
     * Merge an article into this one
     * @param Article|array $article The article
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
    public function merge($article, $metadata = null)
    {
        if ($article instanceof self) {
            $this->mergeDocument($article->getDocument());
            $this->mergeMetadata($article->getMetadata());
        } else {
            $this->mergeDocument($article);
        }
        $this->mergeMetadata($metadata);
        return $this;
    }

    /**
     * Get the object iterator
     * @return \Iterator
     */
    public function getIterator()
    {
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;
        return $document->getIterator();
    }

    /**
     * Get a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyGet($name)
    {
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;
        return $document->{$name};
    }

    /**
     * Set a property value
     * @param  string $name The name of the property
     * @param  mixed $value The new value of the property
     * @return $this
     */
    protected function propertySet($name, $value)
    {
        if (!is_null($this->document)) {
            $this->document->{$name} = $value;
            $this->updateTheme();
        }
        return $this;
    }

    /**
     * Unset a property value
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyUnset($name)
    {
        if (!is_null($this->document)) {
            unset($this->document->{$name});
            $this->updateTheme();
        }
    }

    /**
     * Check if a property exists
     * @param  string $name The name of the property
     * @return mixed|null
     */
    protected function propertyExists($name)
    {
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;
        return isset($document->{$name});
    }

    /**
     * Call method on the document
     * @param  string $name      The name of the method
     * @param  array  $arguments The arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;
        return call_user_func_array([$document, $name], $arguments);
    }

    /**
     * Get the document as array
     * @return array
     */
    public function toArray()
    {
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;
        return $document->toArray();
    }

    /**
     * When cloning an article, clone document and metadata
     */
    public function __clone()
    {
        $document = $this->getDocument();
        $metadata = $this->getMetadata();
        if (!is_null($document)) {
            $this->setDocument(clone $document);
        }
        if (!is_null($metadata)) {
            $this->setMetadata(clone $metadata);
        }
    }
}
