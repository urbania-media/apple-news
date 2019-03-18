<?php

namespace Urbania\AppleNews\Api\Objects;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * See the links returned by the article endpoints.
 *
 * @see https://developer.apple.com/documentation/apple_news/articlelinks
 */
class ArticleLinks implements \JsonSerializable
{
    /**
     * The URL of the channel in which this article appears.
     * @var string
     */
    protected $channel;

    /**
     * The sections, if any, in which this article appears.
     * @var string[]
     */
    protected $sections;

    /**
     * The URL at which this resource can be read, updated, and deleted.
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
        Assert::string($channel);

        $this->channel = $channel;
        return $this;
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
        Assert::string($self);

        $this->self = $self;
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
