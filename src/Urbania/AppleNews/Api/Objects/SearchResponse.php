<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the fields the search article endpoints returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/searchresponse.json
 */
class SearchResponse extends BaseSdkObject
{
    /**
     * A list of article objects.
     * @var Api\Objects\Article[]
     */
    protected $articles;

    /**
     * A list of fields the  and  endpoints return.
     * @var \Urbania\AppleNews\Api\Objects\SearchResponseLinks
     */
    protected $links;

    /**
     * The value you want to set for the pageToken parameter and the
     * parameters that were previously sent to get the next page of results.
     * This field is automatically filled in with the next URL in the links
     * section.
     * @var string
     */
    protected $meta;

    public function __construct(array $data = [])
    {
        if (isset($data['articles'])) {
            $this->setArticles($data['articles']);
        }

        if (isset($data['links'])) {
            $this->setLinks($data['links']);
        }

        if (isset($data['meta'])) {
            $this->setMeta($data['meta']);
        }
    }

    /**
     * Add an item to articles
     * @param \Urbania\AppleNews\Api\Objects\Article|array $item
     * @return $this
     */
    public function addArticle($item)
    {
        return $this->setArticles(
            !is_null($this->articles) ? array_merge($this->articles, [$item]) : [$item]
        );
    }

    /**
     * Add items to articles
     * @param array $items
     * @return $this
     */
    public function addArticles($items)
    {
        Assert::isArray($items);
        return $this->setArticles(
            !is_null($this->articles) ? array_merge($this->articles, $items) : $items
        );
    }

    /**
     * Get the articles
     * @return Api\Objects\Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set the articles
     * @param Api\Objects\Article[] $articles
     * @return $this
     */
    public function setArticles($articles)
    {
        if (is_null($articles)) {
            $this->articles = null;
            return $this;
        }

        Assert::isArray($articles);
        Assert::allIsSdkObject($articles, Article::class);

        $this->articles = is_array($articles)
            ? array_reduce(
                array_keys($articles),
                function ($array, $key) use ($articles) {
                    $item = $articles[$key];
                    $array[$key] = Utils::isAssociativeArray($item) ? new Article($item) : $item;
                    return $array;
                },
                []
            )
            : $articles;
        return $this;
    }

    /**
     * Get the links
     * @return \Urbania\AppleNews\Api\Objects\SearchResponseLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the links
     * @param \Urbania\AppleNews\Api\Objects\SearchResponseLinks|array $links
     * @return $this
     */
    public function setLinks($links)
    {
        if (is_null($links)) {
            $this->links = null;
            return $this;
        }

        Assert::isSdkObject($links, SearchResponseLinks::class);

        $this->links = Utils::isAssociativeArray($links) ? new SearchResponseLinks($links) : $links;
        return $this;
    }

    /**
     * Get the meta
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set the meta
     * @param string $meta
     * @return $this
     */
    public function setMeta($meta)
    {
        if (is_null($meta)) {
            $this->meta = null;
            return $this;
        }

        Assert::string($meta);

        $this->meta = $meta;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->articles)) {
            $data['articles'] = !is_null($this->articles)
                ? array_reduce(
                    array_keys($this->articles),
                    function ($items, $key) {
                        $items[$key] =
                            $this->articles[$key] instanceof Arrayable
                                ? $this->articles[$key]->toArray()
                                : $this->articles[$key];
                        return $items;
                    },
                    []
                )
                : $this->articles;
        }
        if (isset($this->links)) {
            $data['links'] =
                $this->links instanceof Arrayable ? $this->links->toArray() : $this->links;
        }
        if (isset($this->meta)) {
            $data['meta'] = $this->meta;
        }
        return $data;
    }
}
