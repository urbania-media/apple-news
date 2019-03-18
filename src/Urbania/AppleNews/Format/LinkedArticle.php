<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * A relationship between your article and another Apple News article.
 *
 * @see https://developer.apple.com/documentation/apple_news/linkedarticle
 */
class LinkedArticle
{
    /**
     * The URL for the link. Can be either an Apple News link, like
     * https://apple.news/[article_id], or a link to an article on your
     * website, as long as the website link matches the canonicalURL metadata
     * property of the linked article. For more information about
     * canonicalURL, see Metadata.
     * @var uri
     */
    protected $URL;

    /**
     * The type of relationship between the article and the linked document.
     * Valid values:
     * @var string
     */
    protected $relationship;

    public function __construct(array $data = [])
    {
        if (isset($data['URL'])) {
            $this->setURL($data['URL']);
        }

        if (isset($data['relationship'])) {
            $this->setRelationship($data['relationship']);
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
     * Get the URL
     * @return uri
     */
    public function getURL()
    {
        return $this->URL;
    }

    /**
     * Set the relationship
     * @param string $relationship
     * @return $this
     */
    public function setRelationship($relationship)
    {
        Assert::oneOf($relationship, ["related", "promoted"]);

        $this->relationship = $relationship;
        return $this;
    }

    /**
     * Set the URL
     * @param uri $URL
     * @return $this
     */
    public function setURL($URL)
    {
        Assert::uri($URL);

        $this->URL = $URL;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        if (isset($this->URL)) {
            $data['URL'] = $this->URL;
        }
        if (isset($this->relationship)) {
            $data['relationship'] = $this->relationship;
        }
        return $data;
    }
}
