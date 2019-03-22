<?php

namespace Urbania\AppleNews\Contracts;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Format\ArticleDocument;
use Urbania\AppleNews\Api\Objects\Article as ApiArticle;
use Urbania\AppleNews\Api\Objects\CreateArticleMetadataFields;
use Urbania\AppleNews\Api\Objects\UpdateArticleMetadataFields;

interface Article extends JsonSerializable, Arrayable, Jsonable
{
    /**
     * Get the article
     * @return ApiArticle
     */
    public function getArticle();

    /**
     * Set the document and metadata from an article
     * @param ApiArticle|array $article The article
     * @return $this
     */
    public function setArticle($article);

    /**
     * Get the document
     * @return ArticleDocument
     */
    public function getDocument();

    /**
     * Set the document
     * @param ArticleDocument|array|string $document The document
     * @return $this
     */
    public function setDocument($document);

    /**
     * Merge a document into this one
     * @param ArticleDocument|array|string $document The document
     * @return $this
     */
    public function mergeDocument($document);

    /**
     * Get the article metadata
     * @return UpdateArticleMetadataFields|CreateArticleMetadataFields
     */
    public function getMetadata();

    /**
     * Set the article metadata
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
    public function setMetadata($metadata);

    /**
     * Merge metadata into this article
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
    public function mergeMetadata($metadata);

    /**
     * Get the article theme
     * @return Theme
     */
    public function getTheme();

    /**
     * Set the article theme
     * @param Theme $metadata The metadata
     * @return $this
     */
    public function setTheme(Theme $theme);

    /**
     * Set the fonts
     * @param array $fonts An array of fonts path
     * @return $this
     */
    public function setFonts(array $fonts);

    /**
     * Get the fonts
     * @return array
     */
    public function getFonts();

    /**
     * Add a font
     * @param string $path The path of a font
     * @return $this
     */
    public function addFont(string $path);

    /**
     * Add a fonts
     * @param array $fonts An array of fonts
     * @return $this
     */
    public function addFonts(array $fonts);

    /**
     * Set the images
     * @param array $images An array of images path
     * @return $this
     */
    public function setImages(array $images);

    /**
     * Get the images
     * @return array
     */
    public function getImages();

    /**
     * Add a image
     * @param string $path The path of a image
     * @return $this
     */
    public function addImage(string $path);

    /**
     * Add a images
     * @param array $images An array of images
     * @return $this
     */
    public function addImages(array $images);

    /**
     * Merge an article into this one
     * @param Article|array $article The article
     * @param UpdateArticleMetadataFields|CreateArticleMetadataFields|array $metadata The metadata
     * @return $this
     */
    public function merge($article, $metadata = null);
}
