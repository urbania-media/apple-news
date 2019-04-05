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

    protected $id;

    protected $article;

    protected $document;

    protected $documentWithTheme;

    protected $metadata;

    protected $theme;

    protected $fonts = [];

    protected $images = [];

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
    public static function fromFile($path, $metadata = null)
    {
        $contents = file_get_contents($path);
        return static::fromJson($contents, $metadata);
    }

    /**
     * Create an article from a JSON string
     * @param string $json The JSON data
     * @return Article
     */
    public static function fromJson($json, $metadata = null)
    {
        return new static(json_decode($json, true), $metadata);
    }

    /**
     * Get the article id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the article id
     * @param string $is The id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        if (!is_null($this->article) && $this->article->id !== $id) {
            $this->article->id = $id;
        }
        return $this;
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
        $this->setId($this->article->id);
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

        // prettier-ignore
        if (is_null($this->metadata)) {
            $this->setMetadata($metadata);
        } elseif ((
            is_array($metadata) && isset($metadata['revision'])
            && $this->metadata instanceof CreateArticleMetadataFields
        ) || (
            $this->metadata instanceof CreateArticleMetadataFields
            && $metadata instanceof UpdateArticleMetadataFields
        )) {
            $updateMetadata = new UpdateArticleMetadataFields($this->metadata->toArray());
            $updateMetadata->merge($metadata);
            $this->setMetadata($updateMetadata);
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

        if (!is_null($this->theme)) {
            $this->theme->applyFonts($this);
        }
    }

    /**
     * Set the fonts
     * @param array $fonts An array of fonts path
     * @return $this
     */
    public function setFonts(array $fonts)
    {
        $this->fonts = $fonts;
        return $this;
    }

    /**
     * Get the fonts
     * @return array
     */
    public function getFonts()
    {
        return $this->fonts;
    }

    /**
     * Add a font
     * @param string $path The path of a font
     * @return $this
     */
    public function addFont($path)
    {
        $this->fonts[] = $path;
        return $this;
    }

    /**
     * Add a fonts
     * @param array $fonts An array of fonts
     * @return $this
     */
    public function addFonts(array $fonts)
    {
        $this->fonts = array_merge($this->fonts, $fonts);
        return $this;
    }

    /**
     * Set the images
     * @param array $images An array of images path
     * @return $this
     */
    public function setImages(array $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * Get the images
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add a image
     * @param string $path The path of a image
     * @return $this
     */
    public function addImage($path)
    {
        $this->images[] = $path;
        return $this;
    }

    /**
     * Add a images
     * @param array $images An array of images
     * @return $this
     */
    public function addImages(array $images)
    {
        $this->images = array_merge($this->images, $images);
        return $this;
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
        } elseif ($article instanceof ApiArticle) {
            $this->mergeDocument($article->getDocument());
            $this->mergeMetadata($article->toArray());
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
        if ($name === 'id') {
            return $this->getId();
        }
        $document = !is_null($this->documentWithTheme) ? $this->documentWithTheme : $this->document;

        // If the property doesn't exist in the document, try to find it in the
        // article or metadata
        if (!isset($document->{$name})) {
            if (!is_null($this->article) && isset($this->article->{$name})) {
                return $this->article->{$name};
            } elseif (!is_null($this->metadata) && isset($this->metadata->{$name})) {
                return $this->metadata->{$name};
            }
            return null;
        }
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
        if ($name === 'id') {
            return $this->setId($value);
        }
        if (!is_null($this->document) && $this->document->hasProperty($name)) {
            $this->document->{$name} = $value;
            $this->updateTheme();
        } elseif (!is_null($this->article) && $this->article->hasProperty($name)) {
            $this->article->{$name} = $value;
        } elseif (!is_null($this->metadata) && $this->metadata->hasProperty($name)) {
            $this->metadata->{$name} = $value;
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
    public function __call($name, array $arguments)
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
        $article = $this->getArticle();
        $document = $this->getDocument();
        $metadata = $this->getMetadata();
        $theme = $this->getTheme();
        if (!is_null($article)) {
            $this->setArticle(clone $article);
        }
        if (!is_null($document)) {
            $this->setDocument(clone $document);
        }
        if (!is_null($metadata)) {
            $this->setMetadata(clone $metadata);
        }
        if (!is_null($theme)) {
            $this->setMetadata(clone $theme);
        }
    }
}
