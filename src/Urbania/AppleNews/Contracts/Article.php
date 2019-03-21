<?php

namespace Urbania\AppleNews\Contracts;

use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

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
}
