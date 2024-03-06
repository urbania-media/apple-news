<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * A relationship between your article and another Apple News article.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/linkedarticle.json
 */
class LinkedArticle extends BaseSdkObject
{
    /**
     * The type of relationship between the article and the linked document.
     * Valid values:
     * @var string
     */
    protected $relationship;

    /**
     * The URL for the link. Can be either an Apple News link, like
     * https://apple.news/[article_id], or a link to an article on your
     * website, as long as the website link matches the canonicalURL metadata
     * property of the linked article. For more information about
     * canonicalURL, see .
     * @var string
     */
    protected $URL;

    public function __construct(array $data = [])
    {
        if (isset($data['relationship'])) {
            $this->setRelationship($data['relationship']);
        }

        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }
    }

    /**
     * Get the relationship
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Set the relationship
     * @param string $relationship
     * @return $this
     */
    public function setRelationship($relationship)
    {
        Assert::oneOf($relationship, ['related', 'promoted']);

        $this->relationship = $relationship;
        return $this;
    }

    /**
     * Get the URL
     * @return string
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the URL
     * @param string $URL
     * @return $this
     */
    public function setURL($URL)
    {
        Assert::uri($URL);

        $this->URL = $URL;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->relationship)) {
            $data['relationship'] = $this->relationship;
        }
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        return $data;
    }
}
