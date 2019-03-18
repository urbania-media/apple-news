<?php

namespace Urbania\AppleNews\Api\Response;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

class ArticleLinks extends Response
{
    /** @var string */
    protected $channel;

    /** @var string[] */
    protected $sections;

    /** @var string */
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
     * Get the sections
     * @return string[]
     */
    public function getSections()
    {
        return $this->sections;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'channel' => $this->channel,
            'sections' => $this->sections ?? [],
            'self' => $this->self
        ];
    }
}
