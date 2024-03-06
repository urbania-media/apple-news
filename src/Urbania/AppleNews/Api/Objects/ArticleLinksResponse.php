<?php

namespace Urbania\AppleNews\Api\Objects;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * See the links the article endpoints returned.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articlelinksresponse.json
 */
class ArticleLinksResponse extends BaseSdkObject
{
    /**
     * The URL of the channel in which this article appears.
     * @var string
     */
    protected $channel;

    /**
     * The URL of the sections, if any, in which this article appears.
     * @var string[]
     */
    protected $sections;

    /**
     * The URL at which you can read, update, or delete the article.
     * @var string
     */
    protected $self;

    public function __construct(array $data = [])
    {
        if (isset($data['channel'])) {
            $this->setChannel($data['channel']);
        }

        if (isset($data['sections'])) {
            $this->setSections($data['sections']);
        }

        if (isset($data['self'])) {
            $this->setSelf($data['self']);
        }
    }

    /**
     * Get the channel
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Set the channel
     * @param string $channel
     * @return $this
     */
    public function setChannel($channel)
    {
        if (is_null($channel)) {
            $this->channel = null;
            return $this;
        }

        Assert::string($channel);

        $this->channel = $channel;
        return $this;
    }

    /**
     * Add an item to sections
     * @param string $item
     * @return $this
     */
    public function addSection($item)
    {
        return $this->setSections(
            !is_null($this->sections) ? array_merge($this->sections, [$item]) : [$item]
        );
    }

    /**
     * Add items to sections
     * @param array $items
     * @return $this
     */
    public function addSections($items)
    {
        Assert::isArray($items);
        return $this->setSections(
            !is_null($this->sections) ? array_merge($this->sections, $items) : $items
        );
    }

    /**
     * Get the sections
     * @return string[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Set the sections
     * @param string[] $sections
     * @return $this
     */
    public function setSections($sections)
    {
        if (is_null($sections)) {
            $this->sections = null;
            return $this;
        }

        Assert::isArray($sections);
        Assert::allString($sections);

        $this->sections = $sections;
        return $this;
    }

    /**
     * Get the self
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Set the self
     * @param string $self
     * @return $this
     */
    public function setSelf($self)
    {
        if (is_null($self)) {
            $this->self = null;
            return $this;
        }

        Assert::string($self);

        $this->self = $self;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->channel)) {
            $data['channel'] = $this->channel;
        }
        if (isset($this->sections)) {
            $data['sections'] = $this->sections;
        }
        if (isset($this->self)) {
            $data['self'] = $this->self;
        }
        return $data;
    }
}
