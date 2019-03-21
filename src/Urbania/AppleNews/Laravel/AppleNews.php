<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Contracts\Container\Container;
use Urbania\AppleNews\Contracts\Article as ArticleContract;
use Urbania\AppleNews\Contracts\Api as ApiContract;

class AppleNews
{
    protected $container;

    protected $parserManager;

    public function __construct(
        Container $container,
        ParserManager $parserManager
    ) {
        $this->container = $container;
        $this->parserManager = $parserManager;
    }

    public function article($data = [], $metadata = null)
    {
        $article = $this->container->make(ArticleContract::class);
        $article->merge($data, $metadata);
        return $article;
    }

    public function api()
    {
        return $this->container->make(ApiContract::class);
    }

    public function parser($parser = null)
    {
        return $this->parserManager->parser($parser);
    }
}
