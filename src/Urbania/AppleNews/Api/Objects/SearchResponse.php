<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the fields returned by the search article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/searchresponse
 */
class SearchResponse implements \JsonSerializable
{
    /**
     * A list of article objects.
     * @var Api\Objects\Article[]
     */
    protected $articles;

    /**
     * A list of fields returned by the Search Articles in a Section and
     * Search Articles in a Channel endpoints.
     * @var \Urbania\AppleNews\Api\Objects\SearchResponseLinks
     */
    protected $links;

    /**
     * The value that should be set for the pageToken parameter as well as
     * the parameters that were previously sent to get the next page of
     * results. This field is automatically filled in with the next URL in
     * the links section.
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
        Assert::isArray($articles);
        Assert::allIsInstanceOfOrArray($articles, Article::class);

        $items = [];
        foreach ($articles as $key => $item) {
            $items[$key] = is_array($item) ? new Article($item) : $item;
        }
        $this->articles = $items;
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
        if (is_object($links)) {
            Assert::isInstanceOf($links, SearchResponseLinks::class);
        } else {
            Assert::isArray($links);
        }

        $this->links = is_array($links)
            ? new SearchResponseLinks($links)
            : $links;
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
        Assert::string($meta);

        $this->meta = $meta;
        return $this;
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
                        $items[$key] = is_object($this->articles[$key])
                            ? $this->articles[$key]->toArray()
                            : $this->articles[$key];
                        return $items;
                    },
                    []
                )
                : $this->articles;
        }
        if (isset($this->links)) {
            $data['links'] = is_object($this->links)
                ? $this->links->toArray()
                : $this->links;
        }
        if (isset($this->meta)) {
            $data['meta'] = $this->meta;
        }
        return $data;
    }
}
