<?php

namespace Urbania\AppleNews;

use Urbania\AppleNews\Format\ArticleDocument;

class Article
{
    protected $document;

    public function __construct(array $data)
    {
        $this->document = new ArticleDocument($data);
    }

    public function toArray()
    {
        return $this->document->toArray();
    }
}
