<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Contracts\Container\Container;
use Urbania\AppleNews\Contracts\Article as ArticleContract;
use \Urbania\AppleNews\Contracts\Api as ApiContract;

class AppleNews
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function article($data, $metadata = null)
    {
        $article = $this->container->make(ArticleContract::class);

        if ($data instanceof ApiArticle ||
            (is_array($data) && isset($data['document']))
        ) {
            $article->setArticle($data);
        } else {
            $article->setDocument($data);
            $article->setMetadata($metadata);
        }

        return $article;
    }

    public function api()
    {
        return $this->container->make(ApiContract::class);
    }
}
